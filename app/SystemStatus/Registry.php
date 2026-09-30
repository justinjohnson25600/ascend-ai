<?php

declare(strict_types=1);

namespace App\SystemStatus;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * The online half of the system status page: latest releases (Packagist, npm), published security advisories
 * (Packagist, npm) and support dates (endoflife.date). Every lookup fails on its own and says so in errors(),
 * so the page never shows a false all clear.
 */
final class Registry
{
    /** @var array<string, string> */
    private array $errors = [];

    private readonly int $timeout;

    public function __construct(?int $timeout = null)
    {
        $this->timeout = $timeout ?? (int) config('system-status.timeout', 10);
    }

    /**
     * @return array<string, string> lookup => what went wrong
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Latest release of each Composer package, and the newest release in each release line (so a safe update
     * within the installed line is not hidden behind a newer major version). A failed lookup is left out.
     *
     * @param  list<string>  $names
     * @return array<string, array{latest: string, lines: array<string, string>}>
     */
    public function latestComposer(array $names): array
    {
        $responses = $this->pool($names, fn (Pool $pool, string $name) => $pool->as($name)->timeout($this->timeout)->acceptJson()
            ->get('https://repo.packagist.org/p2/'.$name.'.json'));

        $latest = [];

        foreach ($names as $name) {
            $versions = $this->ok($responses[$name] ?? null)?->json('packages.'.$name);
            $lines = is_array($versions) ? Versions::newestPerLine(array_column($versions, 'version')) : [];

            if ($lines === []) {
                $this->errors['packagist:'.$name] = 'Latest version of '.$name.' could not be looked up on Packagist.';

                continue;
            }

            $latest[$name] = ['latest' => reset($lines), 'lines' => $lines];
        }

        return $latest;
    }

    /**
     * Latest release of each npm package, and the newest release in each release line, from npm's abbreviated
     * metadata. A failed lookup is left out.
     *
     * @param  list<string>  $names
     * @return array<string, array{latest: string, lines: array<string, string>}>
     */
    public function latestNpm(array $names): array
    {
        $responses = $this->pool($names, fn (Pool $pool, string $name) => $pool->as($name)->timeout($this->timeout)
            ->withHeaders(['Accept' => 'application/vnd.npm.install-v1+json; q=1.0, application/json; q=0.8'])
            ->get('https://registry.npmjs.org/'.str_replace('/', '%2F', $name)));

        $latest = [];

        foreach ($names as $name) {
            $response = $this->ok($responses[$name] ?? null);
            $versions = $response?->json('versions');
            $lines = is_array($versions) ? Versions::newestPerLine(array_keys($versions)) : [];

            if ($lines === []) {
                $this->errors['npm:'.$name] = 'Latest version of '.$name.' could not be looked up on npm.';

                continue;
            }

            $tagged = $response->json('dist-tags.latest');

            $latest[$name] = [
                'latest' => is_string($tagged) && Versions::isRelease($tagged) ? $tagged : reset($lines),
                'lines' => $lines,
            ];
        }

        return $latest;
    }

    /**
     * Every published advisory for these Composer packages, whatever the version; matching against the
     * installed version happens when the page is shown, so it stays right after a deploy.
     *
     * @param  list<string>  $names
     * @return ?array<string, list<array{title: string, severity: ?string, cve: ?string, link: ?string, affected: string}>> null when the lookup failed
     */
    public function composerAdvisories(array $names): ?array
    {
        if ($names === []) {
            return [];
        }

        try {
            $response = Http::timeout($this->timeout)->acceptJson()->asForm()
                ->post('https://packagist.org/api/security-advisories/', ['packages' => array_values($names)]);
        } catch (Throwable) {
            $response = null;
        }

        $advisories = $this->ok($response)?->json('advisories');

        if (! is_array($advisories)) {
            $this->errors['packagist:advisories'] = 'Security advisories for the PHP packages could not be fetched from Packagist.';

            return null;
        }

        $result = [];

        foreach ($advisories as $name => $list) {
            foreach ((array) $list as $advisory) {
                $result[$name][] = [
                    'title' => (string) ($advisory['title'] ?? 'Security advisory'),
                    'severity' => $advisory['severity'] ?? null,
                    'cve' => $advisory['cve'] ?? null,
                    'link' => $this->safeLink($advisory['link'] ?? null),
                    'affected' => (string) ($advisory['affectedVersions'] ?? '*'),
                ];
            }
        }

        return $result;
    }

    /**
     * Advisories that affect these exact npm package versions (npm filters by version itself).
     *
     * @param  array<string, list<string>>  $locked
     * @return ?array<string, list<array{title: string, severity: ?string, cve: ?string, link: ?string, affected: string}>> null when the lookup failed
     */
    public function npmAdvisories(array $locked): ?array
    {
        if ($locked === []) {
            return [];
        }

        try {
            $response = Http::timeout($this->timeout)->acceptJson()
                ->post('https://registry.npmjs.org/-/npm/v1/security/advisories/bulk', $locked);
        } catch (Throwable) {
            $response = null;
        }

        $advisories = $this->ok($response)?->json();

        if (! is_array($advisories)) {
            $this->errors['npm:advisories'] = 'Security advisories for the JavaScript packages could not be fetched from npm.';

            return null;
        }

        $result = [];

        foreach ($advisories as $name => $list) {
            foreach ((array) $list as $advisory) {
                $result[$name][] = [
                    'title' => (string) ($advisory['title'] ?? 'Security advisory'),
                    'severity' => $advisory['severity'] ?? null,
                    'cve' => null,
                    'link' => $this->safeLink($advisory['url'] ?? null),
                    'affected' => (string) ($advisory['vulnerable_versions'] ?? '*'),
                ];
            }
        }

        return $result;
    }

    /**
     * Support dates for every release line of a product on endoflife.date, for example 'php' or 'laravel'. The
     * page picks the line that is running when it is shown.
     *
     * @return ?array<string, array{latest: ?string, security_until: ?string, active_until: ?string}> null when the lookup failed
     */
    public function supportCycles(string $product): ?array
    {
        try {
            $response = Http::timeout($this->timeout)->acceptJson()->get('https://endoflife.date/api/'.$product.'.json');
        } catch (Throwable) {
            $response = null;
        }

        $cycles = [];

        foreach ((array) ($this->ok($response)?->json() ?? []) as $release) {
            if (isset($release['cycle'])) {
                $cycles[(string) $release['cycle']] = [
                    'latest' => is_string($release['latest'] ?? null) ? $release['latest'] : null,
                    'security_until' => is_string($release['eol'] ?? null) ? $release['eol'] : null,
                    'active_until' => is_string($release['support'] ?? null) ? $release['support'] : null,
                ];
            }
        }

        if ($cycles === []) {
            $this->errors['support:'.$product] = 'Support dates for '.$product.' could not be fetched from endoflife.date.';

            return null;
        }

        return $cycles;
    }

    /**
     * @param  list<string>  $names
     * @return array<string, mixed>
     */
    private function pool(array $names, callable $request): array
    {
        if ($names === []) {
            return [];
        }

        try {
            return Http::pool(fn (Pool $pool) => array_map(fn (string $name) => $request($pool, $name), $names));
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * Advisory links come from outside sources and are shown as links, so only http and https are allowed.
     */
    private function safeLink(mixed $link): ?string
    {
        return is_string($link) && preg_match('#^https?://#i', $link) ? $link : null;
    }

    private function ok(mixed $response): ?Response
    {
        return $response instanceof Response && $response->successful() ? $response : null;
    }
}
