@php
    $labels = [
        'security' => 'Security problem',
        'major' => 'Major upgrade',
        'update' => 'Update',
        'current' => 'Up to date',
        'unknown' => 'Could not check',
        'unchecked' => 'Not checked yet',
        'not-installed' => 'Not on this server',
    ];
    $styles = [
        'security' => 'text-red-300 bg-red-500/10 border-red-400/40',
        'major' => 'text-amber-200 bg-amber-400/10 border-amber-400/40',
        'update' => 'text-accent-300 bg-accent-500/10 border-accent-400/40',
        'current' => 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30',
        'unknown' => 'text-gray-300 bg-white/5 border-white/15',
        'unchecked' => 'text-gray-300 bg-white/5 border-white/15',
        'not-installed' => 'text-gray-400 bg-white/5 border-white/10',
    ];
    $tz = config('system-status.timezone');
    $runtime = $report['runtime'];
    $deployment = $report['deployment'];
    $drift = $report['drift'];
    $support = fn (?array $s): string => $s && $s['security_until'] ? 'Security fixes until '.\Illuminate\Support\Carbon::parse($s['security_until'])->format('j M Y').($s['latest'] ? '. Latest '.$s['cycle'].'.x: '.$s['latest'] : '') : '';
@endphp
<x-layout.app :title="$title" :description="$description" :noIndex="true" body-class="dashboard-bg">
    <div
        class="container-default py-12 space-y-8"
        x-data="{
            message: '',
            async copy() {
                const field = this.$refs.report;
                let copied = false;
                try {
                    await navigator.clipboard.writeText(field.value);
                    copied = true;
                } catch (error) {
                    field.closest('details').open = true;
                    field.select();
                    try { copied = document.execCommand('copy'); } catch (fallbackError) { copied = false; }
                }
                this.message = copied ? 'Copied' : 'Select the text below and copy it';
                setTimeout(() => this.message = '', 4000);
            },
        }"
    >
        {{-- Header --}}
        <div class="card-glass p-8">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                <div>
                    <h1 class="text-display-sm md:text-display-md font-bold text-white">System status</h1>
                    <p class="text-gray-400 mt-1">{{ $report['url'] }} · {{ $runtime['environment'] }}</p>
                    <p class="text-sm text-gray-400 mt-3">
                        Last checked online:
                        <span class="text-white">{{ $report['checked_at'] ? $report['checked_at']->copy()->timezone($tz)->format('j M Y, H:i') : 'never' }}</span>
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <form method="POST" action="{{ route('system-status.check') }}">
                        @csrf
                        <button type="submit" class="btn btn-ghost px-5 py-2.5 w-full">Check now</button>
                    </form>
                    <button type="button" @click="copy()" class="btn btn-primary px-5 py-2.5">
                        <span x-show="!message">Copy for Claude Code</span>
                        <span x-show="message" x-cloak x-text="message"></span>
                    </button>
                </div>
            </div>

            <dl class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="rounded-xl bg-navy-800/60 border border-white/5 p-4">
                    <dt class="text-xs uppercase tracking-wider text-gray-500">PHP</dt>
                    <dd class="text-xl font-semibold text-white">{{ $runtime['php'] }}</dd>
                    <dd class="text-xs text-gray-400 mt-1">{{ $support($report['support']['php'] ?? null) }}</dd>
                </div>
                <div class="rounded-xl bg-navy-800/60 border border-white/5 p-4">
                    <dt class="text-xs uppercase tracking-wider text-gray-500">Laravel</dt>
                    <dd class="text-xl font-semibold text-white">{{ $runtime['laravel'] }}</dd>
                    <dd class="text-xs text-gray-400 mt-1">{{ $support($report['support']['laravel'] ?? null) }}</dd>
                </div>
                <div class="rounded-xl bg-navy-800/60 border border-white/5 p-4">
                    <dt class="text-xs uppercase tracking-wider text-gray-500">Live code</dt>
                    @if ($deployment['commit'])
                        <dd class="text-xl font-semibold text-white font-mono">{{ $deployment['commit'] }}</dd>
                        <dd class="text-xs text-gray-400 mt-1">
                            {{ $deployment['branch'] ?? 'detached' }}@if ($deployment['updated_at']), {{ \Illuminate\Support\Carbon::createFromTimestamp($deployment['updated_at'])->timezone($tz)->format('j M Y, H:i') }}@endif
                        </dd>
                    @else
                        <dd class="text-sm text-gray-300">Not a git checkout</dd>
                    @endif
                </div>
                <div class="rounded-xl bg-navy-800/60 border border-white/5 p-4">
                    <dt class="text-xs uppercase tracking-wider text-gray-500">Found</dt>
                    <dd class="text-sm text-white mt-1 space-y-0.5">
                        @if ($report['summary']['security'] === null)
                            <p><span class="text-amber-200 font-semibold">?</span> security problems (not checked)</p>
                        @else
                            <p><span class="{{ $report['summary']['security'] ? 'text-red-300 font-semibold' : 'text-gray-300' }}">{{ $report['summary']['security'] }}</span> security {{ $report['summary']['security'] === 1 ? 'problem' : 'problems' }}</p>
                        @endif
                        <p><span class="{{ $report['summary']['major'] ? 'text-amber-200 font-semibold' : 'text-gray-300' }}">{{ $report['summary']['major'] }}</span> major {{ $report['summary']['major'] === 1 ? 'upgrade' : 'upgrades' }}</p>
                        <p><span class="{{ $report['summary']['update'] ? 'text-accent-300 font-semibold' : 'text-gray-300' }}">{{ $report['summary']['update'] }}</span> {{ $report['summary']['update'] === 1 ? 'update' : 'updates' }}</p>
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Notices: never an unexplained all clear --}}
        @if (session('status'))
            <div class="rounded-xl border border-emerald-400/30 bg-emerald-400/10 px-5 py-3 text-emerald-200" role="status">{{ session('status') }}</div>
        @endif

        @if (! $report['checked_at'])
            <div class="rounded-xl border border-amber-400/30 bg-amber-400/10 px-5 py-4 text-amber-100">
                Not checked online yet, so only the installed versions are shown. Press <strong>Check now</strong> to look up the latest releases and security problems.
            </div>
        @elseif ($report['stale'])
            <div class="rounded-xl border border-amber-400/30 bg-amber-400/10 px-5 py-4 text-amber-100">
                Packages have changed since the last check, so the latest versions and security results may be out of date. Press <strong>Check now</strong>.
            </div>
        @endif

        @if ($report['errors'] !== [])
            <div class="rounded-xl border border-amber-400/30 bg-amber-400/10 px-5 py-4 text-amber-100">
                <p class="font-semibold mb-2">Some lookups failed on the last check. Where possible the earlier results are shown.</p>
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    @foreach ($report['errors'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Server vs repository --}}
        <div class="card-glass p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Server vs repository</h2>
            <ul class="space-y-2 text-gray-200">
                <li>
                    @if ($drift['lock_mismatches'] === [])
                        <span class="text-emerald-300">✓</span> Installed PHP packages match composer.lock.
                    @else
                        <span class="text-amber-300">!</span> {{ count($drift['lock_mismatches']) }} PHP packages differ from composer.lock. Run <code class="text-amber-100">composer install</code> on the server.
                        <span class="block text-sm text-gray-400 mt-1">{{ collect($drift['lock_mismatches'])->take(10)->map(fn ($m) => $m['name'].' '.($m['installed'] ?? 'missing').' vs '.$m['locked'])->implode(', ') }}</span>
                    @endif
                </li>
                <li>
                    @if ($drift['pending_migrations'] === null)
                        <span class="text-amber-300">!</span> Database migrations could not be read.
                    @elseif ($drift['pending_migrations'] === [])
                        <span class="text-emerald-300">✓</span> No database migrations waiting.
                    @else
                        <span class="text-amber-300">!</span> {{ count($drift['pending_migrations']) }} database migrations waiting: {{ implode(', ', $drift['pending_migrations']) }}
                    @endif
                </li>
                <li>
                    @if ($drift['build_ok'])
                        <span class="text-emerald-300">✓</span> Build files (public/build) present.
                    @else
                        <span class="text-amber-300">!</span> Build files (public/build) missing or incomplete.
                    @endif
                </li>
                <li>
                    @if ($runtime['dev_packages_installed'] && $runtime['environment'] === 'production')
                        <span class="text-amber-300">!</span> Development packages are installed on production. Use <code class="text-amber-100">composer install --no-dev</code>.
                    @else
                        <span class="text-emerald-300">✓</span> Development packages {{ $runtime['dev_packages_installed'] ? 'installed (not production)' : 'not installed' }}.
                    @endif
                </li>
            </ul>
        </div>

        {{-- Security problems --}}
        @if ($report['checked_at'] && (! $report['security_checked']['composer'] || ! $report['security_checked']['npm']))
            <div class="rounded-xl border border-amber-400/30 bg-amber-400/10 px-5 py-4 text-amber-100">
                Security problems could not be checked for the
                {{ ! $report['security_checked']['composer'] && ! $report['security_checked']['npm'] ? 'PHP or JavaScript' : (! $report['security_checked']['composer'] ? 'PHP' : 'JavaScript') }}
                packages, so "none" below would not mean none. Press <strong>Check now</strong> to try again.
            </div>
        @endif

        @if ($report['advisories'] !== [])
            <div class="card-glass p-6">
                <h2 class="text-xl font-semibold text-white mb-4">Security problems ({{ count($report['advisories']) }})</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-navy-700 text-xs uppercase tracking-wider text-gray-500">
                                <th class="py-3 pr-4 font-medium">Package</th>
                                <th class="py-3 pr-4 font-medium">Installed</th>
                                <th class="py-3 pr-4 font-medium">Severity</th>
                                <th class="py-3 font-medium">Problem</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-200">
                            @foreach ($report['advisories'] as $advisory)
                                <tr class="border-b border-navy-800 align-top">
                                    <td class="py-3 pr-4 font-mono whitespace-nowrap">{{ $advisory['package'] }}</td>
                                    <td class="py-3 pr-4 font-mono whitespace-nowrap">{{ $advisory['installed'] }}</td>
                                    <td class="py-3 pr-4 whitespace-nowrap">{{ $advisory['severity'] ? ucfirst($advisory['severity']) : 'Unknown' }}</td>
                                    <td class="py-3">
                                        @if ($advisory['link'])
                                            <a href="{{ $advisory['link'] }}" target="_blank" rel="noopener noreferrer" class="text-accent-400 hover:text-accent-300">{{ $advisory['title'] }}</a>
                                        @else
                                            {{ $advisory['title'] }}
                                        @endif
                                        @if ($advisory['cve'])
                                            <span class="text-gray-500">{{ $advisory['cve'] }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- Packages --}}
        @foreach (['composer' => 'PHP packages (Composer)', 'npm' => 'JavaScript packages (npm)'] as $ecosystem => $heading)
            <div class="card-glass p-6">
                <h2 class="text-xl font-semibold text-white mb-1">{{ $heading }}</h2>
                @if ($ecosystem === 'npm')
                    <p class="text-sm text-gray-400 mb-4">Versions from package-lock.json: what the committed build was made with.</p>
                @else
                    <p class="text-sm text-gray-400 mb-4">Versions installed on this server.</p>
                @endif
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-navy-700 text-xs uppercase tracking-wider text-gray-500">
                                <th class="py-3 pr-4 font-medium">Package</th>
                                <th class="py-3 pr-4 font-medium">Allowed</th>
                                <th class="py-3 pr-4 font-medium">Installed</th>
                                <th class="py-3 pr-4 font-medium">Latest</th>
                                <th class="py-3 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-200">
                            @foreach ($report['packages'] as $package)
                                @continue($package['ecosystem'] !== $ecosystem)
                                <tr class="border-b border-navy-800">
                                    <td class="py-3 pr-4 font-mono whitespace-nowrap">
                                        {{ $package['name'] }}
                                        @if ($package['dev'])
                                            <span class="ml-1 text-[10px] uppercase tracking-wider text-gray-500 font-sans">dev</span>
                                        @endif
                                    </td>
                                    <td class="py-3 pr-4 font-mono text-gray-400 whitespace-nowrap">{{ $package['constraint'] }}</td>
                                    <td class="py-3 pr-4 font-mono whitespace-nowrap">{{ $package['installed'] ?? '—' }}</td>
                                    <td class="py-3 pr-4 font-mono whitespace-nowrap">
                                        @if ($package['in_range'])
                                            {{ $package['in_range'] }}
                                            @if ($package['latest'] && $package['latest'] !== $package['in_range'])
                                                <span class="block text-xs text-gray-500 font-sans">newest {{ $package['latest'] }}</span>
                                            @endif
                                        @else
                                            {{ $package['latest'] ?? '—' }}
                                        @endif
                                    </td>
                                    <td class="py-3 whitespace-nowrap">
                                        <span class="text-xs font-medium rounded-full border px-2.5 py-0.5 {{ $styles[$package['status']] }}">{{ $labels[$package['status']] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        {{-- The text that "Copy for Claude Code" copies; also the fallback when the browser blocks copying --}}
        <details class="card-glass p-6">
            <summary class="cursor-pointer text-white font-semibold">The text that gets copied</summary>
            <textarea x-ref="report" readonly rows="16" class="mt-4 w-full rounded-lg bg-navy-900 border border-navy-700 p-4 font-mono text-xs text-gray-200">{{ $text }}</textarea>
        </details>
    </div>
</x-layout.app>
