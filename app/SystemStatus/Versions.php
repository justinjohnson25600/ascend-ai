<?php

declare(strict_types=1);

namespace App\SystemStatus;

/**
 * Version arithmetic for the system status page: normalising, grouping versions into release lines,
 * classifying an available update, and matching an installed version against Packagist's affected-version
 * ranges (composer/semver is not installed here).
 */
final class Versions
{
    public static function normalise(?string $version): ?string
    {
        if ($version === null) {
            return null;
        }

        return ltrim(trim($version), 'vV');
    }

    /**
     * A plain numbered release, such as 1.2.3: no pre-release suffix, no development branch.
     */
    public static function isRelease(?string $version): bool
    {
        return (bool) preg_match('/^\d+(\.\d+)*$/', (string) self::normalise($version));
    }

    /**
     * The release line a version belongs to: its major version, or its minor version below 1.0, where a new
     * minor version can break things.
     */
    public static function line(string $version): string
    {
        [$major, $minor] = array_pad(explode('.', (string) self::normalise($version)), 2, '0');

        return (int) $major === 0 ? '0.'.(int) $minor : (string) (int) $major;
    }

    /**
     * current: nothing newer. update: a newer release in the installed line (safe to take). major: only a newer
     * line (a breaking upgrade). unknown: the latest version could not be looked up, or the installed version is
     * a development branch. not-installed: not on this server (for example a development-only package on a
     * production install).
     */
    public static function classify(?string $installed, ?string $latest, ?string $newestInLine = null): string
    {
        $installed = self::normalise($installed);
        $latest = self::normalise($latest);
        $newestInLine = self::normalise($newestInLine);

        if ($installed === null) {
            return 'not-installed';
        }

        if ($latest === null || ! preg_match('/^\d+(\.\d+)*/', $installed) || str_ends_with($installed, '-dev')) {
            return 'unknown';
        }

        if ($newestInLine !== null && version_compare($newestInLine, $installed, '>')) {
            return 'update';
        }

        if (version_compare($latest, $installed, '<=')) {
            return 'current';
        }

        return self::line($latest) === self::line($installed) ? 'update' : 'major';
    }

    /**
     * Packagist ranges look like ">=8.0.0,<8.0.1|<7.15.2": "|" separates alternatives, "," joins conditions.
     * A range that cannot be read, or a development branch, counts as affected, so a problem is never hidden.
     * A branch alias such as 12.x-dev is treated as the newest version of its line, as Composer does.
     */
    public static function affected(string $version, string $range): bool
    {
        $version = (string) self::normalise($version);

        if (str_starts_with($version, 'dev-')) {
            return true;
        }

        if (preg_match('/^(\d+(?:\.\d+)*)\.x-dev$/', $version, $alias)) {
            $version = $alias[1].'.9999999';
        }

        foreach (explode('|', $range) as $alternative) {
            $matches = true;

            foreach (explode(',', $alternative) as $condition) {
                $result = self::meets($version, trim($condition));

                if ($result === null) {
                    return true;
                }

                if (! $result) {
                    $matches = false;
                    break;
                }
            }

            if ($matches) {
                return true;
            }
        }

        return false;
    }

    /**
     * The newest version in each release line, newest line first.
     *
     * @param  iterable<mixed>  $versions
     * @return array<string, string> line => newest version in it
     */
    public static function newestPerLine(iterable $versions): array
    {
        $releases = [];

        foreach ($versions as $version) {
            if (is_string($version) && self::isRelease($version)) {
                $releases[] = $version;
            }
        }

        usort($releases, fn (string $a, string $b): int => version_compare((string) self::normalise($b), (string) self::normalise($a)));

        $lines = [];

        foreach ($releases as $version) {
            $lines[self::line($version)] ??= $version;
        }

        return $lines;
    }

    private static function meets(string $version, string $condition): ?bool
    {
        if ($condition === '*' || $condition === '') {
            return true;
        }

        if (preg_match('/^v?(\d+(?:\.\d+)*)\.\*$/', $condition, $wildcard)) {
            return str_starts_with($version.'.', $wildcard[1].'.');
        }

        if (! preg_match('/^(>=|<=|>|<|==|=|!=)?\s*v?(\d[\w.\-]*)$/', $condition, $parts)) {
            return null;
        }

        $operator = match ($parts[1]) {
            '', '=' => '==',
            default => $parts[1],
        };

        return version_compare($version, $parts[2], $operator);
    }
}
