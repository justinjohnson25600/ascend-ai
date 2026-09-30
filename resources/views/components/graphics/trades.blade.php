@php
    // The trades we specialise in: label and icon path.
    $trades = [
        ['Builders', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['Electricians', 'M13 10V3L4 14h7v7l9-11h-7z'],
        ['Plumbing and heating', 'M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z'],
        ['Roofers', 'M2 13l10-9 10 9M5 11v9h14v-9M16 7V4h2v4.8'],
        ['Joiners and carpenters', 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
        ['Plasterers and decorators', 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'],
        ['Groundworkers and landscapers', 'M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1'],
        ['Kitchen and bathroom fitters', 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
    ];
@endphp
<figure
    class="relative w-full max-w-md mx-auto"
    data-graphic="trades"
    role="img"
    aria-label="Who we work with: small building firms and trades of 1 to 25 people, including builders, electricians, plumbing and heating engineers, roofers, joiners and carpenters, plasterers and decorators, groundworkers and landscapers, and kitchen and bathroom fitters."
>
    <div class="relative rounded-2xl border border-white/10 bg-navy-900/80 p-5 sm:p-6 shadow-2xl shadow-black/40 text-left" aria-hidden="true">
        <p class="text-[11px] uppercase tracking-wider text-gray-500 mb-4">Built for</p>

        <ul class="grid grid-cols-2 gap-2.5">
            @foreach ($trades as $i => [$label, $icon])
                <li class="flex items-center gap-2.5 rounded-xl border border-white/5 bg-navy-800/60 p-2.5">
                    <span class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center {{ $i % 3 === 0 ? 'bg-accent-500/15 text-accent-300' : ($i % 3 === 1 ? 'bg-purple-400/15 text-purple-300' : 'bg-emerald-400/10 text-emerald-300') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                    </span>
                    <span class="text-xs font-medium leading-tight text-gray-200">{{ $label }}</span>
                </li>
            @endforeach
        </ul>

        <div class="mt-4 flex items-center gap-3 rounded-xl border border-accent-400/30 bg-accent-500/10 px-4 py-3">
            <svg class="w-5 h-5 flex-shrink-0 text-accent-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <p class="text-sm text-gray-100">From one person and a van to a team of 25.</p>
        </div>
    </div>
</figure>
