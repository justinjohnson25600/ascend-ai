<?php

declare(strict_types=1);

namespace App\SystemStatus;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * The system status report: what is installed (read live on every view) combined with the last online check
 * (cached until the next one), plus a plain-text version to paste into Claude Code.
 */
final class StatusReport
{
    public const CACHE_KEY = 'system-status';

    private const STATUS_ORDER = ['security' => 0, 'major' => 1, 'update' => 2, 'unknown' => 3, 'unchecked' => 4, 'current' => 5, 'not-installed' => 6];

    private const SEVERITY_ORDER = ['critical' => 0, 'high' => 1, 'medium' => 2, 'moderate' => 2, 'low' => 3];

    public function __construct(private readonly Inventory $inventory, private readonly Registry $registry) {}

    /**
     * Look everything up online and cache it. A lookup that fails keeps the previous result, and the failure
     * is recorded so the page says which part is out of date.
     *
     * @return array<string, mixed>
     */
    public function check(): array
    {
        $previous = Cache::get(self::CACHE_KEY, []);
        $installed = $this->inventory->composerInstalled();
        $locked = $this->inventory->npmLocked();
        $errors = [];

        $composerAdvisories = $this->registry->composerAdvisories(array_keys($installed));

        if ($this->inventory->npmLockMissing()) {
            $npmAdvisories = null;
            $errors[] = 'package-lock.json is missing or in a format that cannot be read, so the JavaScript packages could not be checked for security problems.';
        } else {
            $npmAdvisories = $this->registry->npmAdvisories($locked);
        }

        $data = [
            'checked_at' => now()->toIso8601String(),
            'latest' => [
                'composer' => array_merge($previous['latest']['composer'] ?? [], $this->registry->latestComposer(array_column($this->inventory->composerPackages(), 'name'))),
                'npm' => array_merge($previous['latest']['npm'] ?? [], $this->registry->latestNpm(array_column($this->inventory->npmPackages(), 'name'))),
            ],
            'advisories' => [
                'composer' => $composerAdvisories ?? ($previous['advisories']['composer'] ?? null),
                'npm' => $npmAdvisories ?? ($previous['advisories']['npm'] ?? null),
            ],
            // What the advisories were checked against: Composer package names, and npm names with their versions.
            'checked' => [
                'composer' => $composerAdvisories !== null ? $this->fingerprint(array_keys($installed)) : ($previous['checked']['composer'] ?? null),
                'npm' => $npmAdvisories !== null ? $locked : ($previous['checked']['npm'] ?? null),
            ],
            'support' => [
                'php' => $this->registry->supportCycles('php') ?? ($previous['support']['php'] ?? null),
                'laravel' => $this->registry->supportCycles('laravel') ?? ($previous['support']['laravel'] ?? null),
            ],
            'errors' => [...array_values($this->registry->errors()), ...$errors],
        ];

        Cache::forever(self::CACHE_KEY, $data);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function build(): array
    {
        $data = Cache::get(self::CACHE_KEY);
        $data = is_array($data) ? $data : null;
        $runtime = $this->inventory->runtime();
        $installed = $this->inventory->composerInstalled();
        $locked = $this->inventory->npmLocked();

        $securityChecked = [
            'composer' => ($data['advisories']['composer'] ?? null) !== null,
            'npm' => ($data['advisories']['npm'] ?? null) !== null,
        ];

        $advisories = $this->matchAdvisories($data, $installed, $locked);
        $withAdvisories = array_flip(array_map(fn (array $a) => $a['ecosystem'].':'.$a['package'], $advisories));

        $packages = [];

        foreach ([...$this->inventory->composerPackages(), ...$this->inventory->npmPackages()] as $package) {
            $entry = $data['latest'][$package['ecosystem']][$package['name']] ?? null;
            $entry = is_string($entry) ? ['latest' => $entry, 'lines' => []] : $entry;
            $latest = $entry['latest'] ?? null;
            $newestInLine = $package['installed'] !== null && preg_match('/^v?\d/', $package['installed'])
                ? ($entry['lines'][Versions::line($package['installed'])] ?? null)
                : null;

            $status = match (true) {
                $package['installed'] === null => 'not-installed',
                isset($withAdvisories[$package['ecosystem'].':'.$package['name']]) => 'security',
                $data === null => 'unchecked',
                default => Versions::classify($package['installed'], $latest, $newestInLine),
            };

            $inRange = $newestInLine !== null && version_compare((string) Versions::normalise($newestInLine), (string) Versions::normalise($package['installed']), '>')
                ? $newestInLine
                : null;

            $packages[] = [...$package, 'latest' => $latest, 'in_range' => $inRange, 'status' => $status];
        }

        usort($packages, fn (array $a, array $b) => [$a['ecosystem'], self::STATUS_ORDER[$a['status']], $a['name']] <=> [$b['ecosystem'], self::STATUS_ORDER[$b['status']], $b['name']]);

        $counts = array_count_values(array_column($packages, 'status'));

        return [
            'site' => config('app.name'),
            'url' => url('/'),
            'checked_at' => isset($data['checked_at']) ? Carbon::parse($data['checked_at']) : null,
            'errors' => $data['errors'] ?? [],
            'stale' => $data !== null && (
                ($data['checked']['composer'] ?? null) !== $this->fingerprint(array_keys($installed))
                || ($data['checked']['npm'] ?? null) !== $locked
            ),
            'runtime' => $runtime,
            'support' => [
                'php' => $this->supportFor($data['support']['php'] ?? null, PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION),
                'laravel' => $this->supportFor($data['support']['laravel'] ?? null, strtok($runtime['laravel'], '.') ?: ''),
            ],
            'deployment' => $this->inventory->deployment(),
            'drift' => $this->inventory->drift(),
            'packages' => $packages,
            'advisories' => $advisories,
            'security_checked' => $securityChecked,
            'summary' => [
                'security' => $securityChecked['composer'] || $securityChecked['npm'] ? count($advisories) : null,
                'major' => $counts['major'] ?? 0,
                'update' => $counts['update'] ?? 0,
            ],
        ];
    }

    /**
     * The report as plain text, to paste into Claude Code and ask for update prompts.
     *
     * @param  array<string, mixed>  $report
     */
    public function text(array $report): string
    {
        $runtime = $report['runtime'];
        $deployment = $report['deployment'];
        $drift = $report['drift'];
        $lines = [];

        $lines[] = $report['site'].' ('.$report['url'].'), system status, checked '.($report['checked_at'] ? $this->when($report['checked_at']) : 'never (installed versions only)');
        $lines[] = 'Environment: '.$runtime['environment']
            .' | PHP '.$runtime['php'].$this->supportNote($report['support']['php'])
            .' | Laravel '.$runtime['laravel'].$this->supportNote($report['support']['laravel'])
            .' | development packages '.($runtime['dev_packages_installed'] ? 'installed' : 'not installed');
        $lines[] = 'Live code: '.($deployment['commit']
            ? ($deployment['branch'] ?? 'detached').' @ '.$deployment['commit'].($deployment['updated_at'] ? ', updated '.$this->when(Carbon::createFromTimestamp($deployment['updated_at'])) : '').($deployment['message'] ? ' ("'.$deployment['message'].'")' : '')
            : 'not a git checkout');
        $lines[] = 'Server vs repository: '.($drift['lock_mismatches'] === [] ? 'installed packages match composer.lock' : count($drift['lock_mismatches']).' packages differ from composer.lock ('.implode(', ', array_map(fn ($m) => $m['name'].' '.($m['installed'] ?? 'missing').' vs '.$m['locked'], array_slice($drift['lock_mismatches'], 0, 8))).')')
            .' | '.($drift['pending_migrations'] === null ? 'migrations could not be read' : ($drift['pending_migrations'] === [] ? 'no migrations waiting' : count($drift['pending_migrations']).' migrations waiting: '.implode(', ', $drift['pending_migrations'])))
            .' | build files '.($drift['build_ok'] ? 'present' : 'missing or incomplete');

        if ($report['stale']) {
            $lines[] = 'Note: packages have changed since the last online check, so latest versions and security results may be out of date.';
        }

        $byPackage = [];

        foreach ($report['advisories'] as $advisory) {
            $byPackage[$advisory['ecosystem'].' '.$advisory['package'].' '.$advisory['installed']][] = $advisory;
        }

        $checked = $report['security_checked'];
        $lines[] = '';

        if (! $report['checked_at']) {
            $lines[] = 'Security problems: not checked yet';
        } elseif (! $checked['composer'] && ! $checked['npm']) {
            $lines[] = 'Security problems: not checked, the security lookups have not succeeded';
        } else {
            $lines[] = 'Security problems ('.count($report['advisories']).' across '.count($byPackage).' packages; full list on the page)'
                .(! $checked['composer'] ? ' (PHP packages not checked: the lookup failed)' : '')
                .(! $checked['npm'] ? ' (JavaScript packages not checked: the lookup failed)' : '');

            foreach ($byPackage as $package => $advisories) {
                $severities = array_count_values(array_map(fn (array $a) => strtolower((string) ($a['severity'] ?? 'unknown')), $advisories));
                $breakdown = implode(', ', array_map(fn (string $severity, int $count) => $count.' '.$severity, array_keys($severities), $severities));
                $first = $advisories[0];

                $lines[] = '- '.$package.': '.count($advisories).' '.(count($advisories) === 1 ? 'advisory' : 'advisories').' ('.$breakdown.'), e.g. "'.trim($first['title']).'"'
                    .($first['cve'] ? ' '.$first['cve'] : '').($first['link'] ? ' '.$first['link'] : '');
            }

            if ($byPackage === []) {
                $lines[] = '- none found';
            }
        }

        foreach (['composer' => 'PHP packages (Composer)', 'npm' => 'JavaScript packages (npm, versions in package-lock.json)'] as $ecosystem => $heading) {
            $lines[] = '';
            $lines[] = $heading.': name allowed: installed -> newest in its line (newest overall) [status]';

            foreach ($report['packages'] as $package) {
                if ($package['ecosystem'] !== $ecosystem) {
                    continue;
                }

                $target = $package['in_range'] ?? $package['latest'] ?? '?';
                $overall = $package['in_range'] !== null && $package['latest'] !== null && $package['latest'] !== $package['in_range'] ? ' (newest '.$package['latest'].')' : '';

                $lines[] = '- '.$package['name'].($package['dev'] ? ' (dev)' : '').' '.$package['constraint'].': '
                    .($package['installed'] ?? 'not installed').' -> '.$target.$overall.' ['.$package['status'].']';
            }
        }

        if ($report['errors'] !== []) {
            $lines[] = '';
            $lines[] = 'Could not check on the last run: '.implode(' ', $report['errors']);
        }

        $lines[] = '';
        $lines[] = 'Please give me the update prompts for this site, grouped and in order.';

        return implode("\n", $lines);
    }

    /**
     * Composer advisories are matched against the versions installed now. npm filters by version when it is
     * asked, so an npm advisory is kept only while the package still has a version that was checked; once a fix
     * is deployed the advisory drops away until the next check.
     *
     * @param  ?array<string, mixed>  $data
     * @param  array<string, string>  $installed
     * @param  array<string, list<string>>  $locked
     * @return list<array{ecosystem: string, package: string, installed: string, title: string, severity: ?string, cve: ?string, link: ?string}>
     */
    private function matchAdvisories(?array $data, array $installed, array $locked): array
    {
        $matched = [];

        foreach ($data['advisories']['composer'] ?? [] as $name => $list) {
            if (! isset($installed[$name])) {
                continue;
            }

            foreach ($list as $advisory) {
                if (Versions::affected($installed[$name], $advisory['affected'])) {
                    $matched[] = ['ecosystem' => 'composer', 'package' => $name, 'installed' => $installed[$name], ...$this->advisoryFields($advisory)];
                }
            }
        }

        foreach ($data['advisories']['npm'] ?? [] as $name => $list) {
            $stillChecked = array_values(array_intersect($locked[$name] ?? [], $data['checked']['npm'][$name] ?? []));

            if ($stillChecked === []) {
                continue;
            }

            foreach ($list as $advisory) {
                $matched[] = ['ecosystem' => 'npm', 'package' => $name, 'installed' => implode(', ', $stillChecked), ...$this->advisoryFields($advisory)];
            }
        }

        $unique = [];

        foreach ($matched as $advisory) {
            $unique[$advisory['ecosystem'].'|'.$advisory['package'].'|'.$advisory['title'].'|'.$advisory['link']] = $advisory;
        }

        $matched = array_values($unique);

        usort($matched, fn (array $a, array $b) => [self::SEVERITY_ORDER[strtolower((string) $a['severity'])] ?? 4, $a['package']]
            <=> [self::SEVERITY_ORDER[strtolower((string) $b['severity'])] ?? 4, $b['package']]);

        return $matched;
    }

    /**
     * @param  array<string, mixed>  $advisory
     * @return array{title: string, severity: ?string, cve: ?string, link: ?string}
     */
    private function advisoryFields(array $advisory): array
    {
        return [
            'title' => $advisory['title'],
            'severity' => $advisory['severity'],
            'cve' => $advisory['cve'],
            'link' => $advisory['link'],
        ];
    }

    /**
     * The support dates for the release line running now, from the cached list of every line.
     *
     * @param  ?array<string, mixed>  $cycles
     * @return ?array{cycle: string, latest: ?string, security_until: ?string, active_until: ?string}
     */
    private function supportFor(?array $cycles, string $cycle): ?array
    {
        $release = $cycles[$cycle] ?? null;

        return is_array($release) ? ['cycle' => $cycle, ...$release] : null;
    }

    /**
     * @param  ?array<string, mixed>  $support
     */
    private function supportNote(?array $support): string
    {
        if ($support === null) {
            return '';
        }

        $parts = [];

        if ($support['security_until']) {
            $parts[] = 'security fixes until '.$support['security_until'];
        }

        if ($support['latest']) {
            $parts[] = 'latest '.$support['cycle'].'.x is '.$support['latest'];
        }

        return $parts === [] ? '' : ' ('.implode(', ', $parts).')';
    }

    private function when(Carbon $time): string
    {
        return $time->copy()->timezone(config('system-status.timezone'))->format('j M Y, H:i');
    }

    /**
     * @param  array<mixed>  $value
     */
    private function fingerprint(array $value): string
    {
        return md5((string) json_encode($value));
    }
}
