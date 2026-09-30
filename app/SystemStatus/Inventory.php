<?php

declare(strict_types=1);

namespace App\SystemStatus;

use Composer\InstalledVersions;
use Illuminate\Database\Migrations\Migrator;
use Throwable;

/**
 * What is installed on this server, read from local files only (no network, no shell): the direct Composer and
 * npm packages, the runtime, the deployed git commit, and whether the server matches the repository.
 */
final class Inventory
{
    private readonly string $basePath;

    /**
     * @param  ?array<string, string>  $installed  name => version, instead of reading Composer's installed list (for tests)
     * @param  ?bool  $devInstalled  whether development packages are installed, instead of asking Composer (for tests)
     */
    public function __construct(?string $basePath = null, private readonly ?array $installed = null, private readonly ?bool $devInstalled = null)
    {
        $this->basePath = $basePath ?? base_path();
    }

    /**
     * Direct Composer packages from composer.json, with the version installed on this server (null when it is
     * not installed here, for example a development package on a production install) and the version in
     * composer.lock.
     *
     * @return list<array{ecosystem: string, name: string, constraint: string, dev: bool, installed: ?string, locked: ?string}>
     */
    public function composerPackages(): array
    {
        $manifest = $this->json('composer.json');
        $locked = $this->composerLocked();
        $packages = [];

        foreach (['require' => false, 'require-dev' => true] as $section => $dev) {
            foreach ($manifest[$section] ?? [] as $name => $constraint) {
                if (! str_contains($name, '/')) {
                    continue; // php, ext-*, lib-*: platform requirements, not packages
                }

                $packages[] = [
                    'ecosystem' => 'composer',
                    'name' => $name,
                    'constraint' => (string) $constraint,
                    'dev' => $dev,
                    'installed' => $this->composerInstalledVersion($name),
                    'locked' => $locked[$name] ?? null,
                ];
            }
        }

        return $packages;
    }

    /**
     * Every Composer package installed on this server, direct or not, for the security check.
     *
     * @return array<string, string>
     */
    public function composerInstalled(): array
    {
        if ($this->installed !== null) {
            return $this->installed;
        }

        $root = InstalledVersions::getRootPackage()['name'] ?? null;
        $installed = [];

        foreach (InstalledVersions::getInstalledPackages() as $name) {
            $version = $name === $root ? null : $this->composerInstalledVersion($name);

            if ($version !== null) {
                $installed[$name] = $version;
            }
        }

        ksort($installed);

        return $installed;
    }

    /**
     * Direct npm packages from package.json, with the version in package-lock.json. The live server builds
     * nothing (public/build is committed), so the lock file is the record of what the build used.
     *
     * @return list<array{ecosystem: string, name: string, constraint: string, dev: bool, installed: ?string, locked: ?string}>
     */
    public function npmPackages(): array
    {
        $manifest = $this->json('package.json');
        $lock = $this->json('package-lock.json')['packages'] ?? [];
        $packages = [];

        foreach (['dependencies' => false, 'devDependencies' => true] as $section => $dev) {
            foreach ($manifest[$section] ?? [] as $name => $constraint) {
                $version = $lock['node_modules/'.$name]['version'] ?? null;

                $packages[] = [
                    'ecosystem' => 'npm',
                    'name' => $name,
                    'constraint' => (string) $constraint,
                    'dev' => $dev,
                    'installed' => $version,
                    'locked' => $version,
                ];
            }
        }

        return $packages;
    }

    /**
     * Every npm package in package-lock.json with the versions used, for the security check.
     *
     * @return array<string, list<string>>
     */
    public function npmLocked(): array
    {
        $locked = [];

        foreach ($this->json('package-lock.json')['packages'] ?? [] as $path => $package) {
            $position = strrpos($path, 'node_modules/');

            if ($position === false || ! isset($package['version'])) {
                continue;
            }

            $name = substr($path, $position + strlen('node_modules/'));
            $locked[$name][] = $package['version'];
        }

        foreach ($locked as $name => $versions) {
            $locked[$name] = array_values(array_unique($versions));
        }

        ksort($locked);

        return $locked;
    }

    /**
     * Whether package.json lists packages but package-lock.json gives no versions for them (missing, or a lock
     * format that is not version 2 or 3), in which case the JavaScript packages cannot be checked.
     */
    public function npmLockMissing(): bool
    {
        $manifest = $this->json('package.json');

        return (($manifest['dependencies'] ?? []) !== [] || ($manifest['devDependencies'] ?? []) !== []) && $this->npmLocked() === [];
    }

    /**
     * @return array{php: string, laravel: string, environment: string, dev_packages_installed: bool}
     */
    public function runtime(): array
    {
        return [
            'php' => PHP_VERSION,
            'laravel' => app()->version(),
            'environment' => (string) app()->environment(),
            'dev_packages_installed' => $this->devInstalled ?? (bool) (InstalledVersions::getRootPackage()['dev'] ?? false),
        ];
    }

    /**
     * The commit checked out on this server, read from .git without running git.
     *
     * @return array{commit: ?string, branch: ?string, updated_at: ?int, message: ?string}
     */
    public function deployment(): array
    {
        $git = $this->basePath.DIRECTORY_SEPARATOR.'.git';
        $none = ['commit' => null, 'branch' => null, 'updated_at' => null, 'message' => null];

        $head = is_file($git.'/HEAD') ? trim((string) @file_get_contents($git.'/HEAD')) : '';

        if ($head === '') {
            return $none;
        }

        $branch = null;
        $commit = $head;

        if (str_starts_with($head, 'ref: ')) {
            $ref = substr($head, 5);
            $branch = str_replace('refs/heads/', '', $ref);
            $commit = is_file($git.'/'.$ref) ? trim((string) @file_get_contents($git.'/'.$ref)) : $this->packedRef($git, $ref);
        }

        [$updatedAt, $message] = $this->lastReflogEntry($git.'/logs/HEAD');

        return [
            'commit' => $commit !== null && $commit !== '' ? substr($commit, 0, 7) : null,
            'branch' => $branch,
            'updated_at' => $updatedAt,
            'message' => $message,
        ];
    }

    /**
     * Whether this server matches the repository: installed Composer packages against composer.lock, database
     * migrations waiting to run, and the committed build files.
     *
     * @return array{lock_mismatches: list<array{name: string, locked: string, installed: ?string}>, pending_migrations: ?list<string>, build_ok: bool}
     */
    public function drift(): array
    {
        $includeDev = $this->runtime()['dev_packages_installed'];
        $lock = $this->json('composer.lock');
        $mismatches = [];

        foreach (['packages' => true, 'packages-dev' => $includeDev] as $section => $check) {
            if (! $check) {
                continue;
            }

            foreach ($lock[$section] ?? [] as $package) {
                $installed = $this->composerInstalledVersion($package['name']);

                if (Versions::normalise($installed) !== Versions::normalise($package['version'])) {
                    $mismatches[] = ['name' => $package['name'], 'locked' => $package['version'], 'installed' => $installed];
                }
            }
        }

        return [
            'lock_mismatches' => $mismatches,
            'pending_migrations' => $this->pendingMigrations(),
            'build_ok' => $this->buildIsComplete(),
        ];
    }

    private function composerInstalledVersion(string $name): ?string
    {
        if ($this->installed !== null) {
            return $this->installed[$name] ?? null;
        }

        try {
            return InstalledVersions::isInstalled($name) ? InstalledVersions::getPrettyVersion($name) : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @return array<string, string>
     */
    private function composerLocked(): array
    {
        $lock = $this->json('composer.lock');
        $locked = [];

        foreach (['packages', 'packages-dev'] as $section) {
            foreach ($lock[$section] ?? [] as $package) {
                $locked[$package['name']] = $package['version'];
            }
        }

        return $locked;
    }

    /**
     * null when the migrations table cannot be read (for example no database connection).
     *
     * @return ?list<string>
     */
    private function pendingMigrations(): ?array
    {
        try {
            /** @var Migrator $migrator */
            $migrator = app('migrator');

            if (! $migrator->repositoryExists()) {
                return null;
            }

            $files = array_keys($migrator->getMigrationFiles([database_path('migrations')]));

            return array_values(array_diff($files, $migrator->getRepository()->getRan()));
        } catch (Throwable) {
            return null;
        }
    }

    private function buildIsComplete(): bool
    {
        $manifest = $this->json('public/build/manifest.json');

        if ($manifest === []) {
            return false;
        }

        foreach ($manifest as $entry) {
            if (isset($entry['file']) && ! is_file($this->basePath.'/public/build/'.$entry['file'])) {
                return false;
            }
        }

        return true;
    }

    private function packedRef(string $git, string $ref): ?string
    {
        foreach (@file($git.'/packed-refs', FILE_IGNORE_NEW_LINES) ?: [] as $line) {
            if (str_ends_with($line, ' '.$ref)) {
                return strtok($line, ' ') ?: null;
            }
        }

        return null;
    }

    /**
     * @return array{0: ?int, 1: ?string}
     */
    private function lastReflogEntry(string $path): array
    {
        $lines = @file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        $last = end($lines);

        if (! is_string($last) || ! preg_match('/ (\d{9,11}) [+-]\d{4}\t(.*)$/', $last, $parts)) {
            return [null, null];
        }

        return [(int) $parts[1], $parts[2]];
    }

    /**
     * @return array<mixed>
     */
    private function json(string $relativePath): array
    {
        $path = $this->basePath.DIRECTORY_SEPARATOR.$relativePath;

        if (! is_file($path)) {
            return [];
        }

        $data = json_decode((string) file_get_contents($path), true);

        return is_array($data) ? $data : [];
    }
}
