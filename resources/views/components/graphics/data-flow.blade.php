@php
    $nodes = [
        ['Your systems', 'Inbox, calendar, accounts. Your data stays here wherever the design allows.', 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4', 'bg-navy-800 border border-accent-400/30 text-accent-300'],
        ['Your automation', 'Built for you, run on hosting we manage, owned by you.', 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'bg-accent-500 text-white shadow-lg shadow-accent-500/30'],
        ['The AI provider', 'Reads only the part it needs and sends back an answer. Not allowed to train on it.', 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'bg-navy-800 border border-purple-400/30 text-purple-300'],
    ];
@endphp
<figure
    class="relative w-full max-w-md mx-auto"
    data-graphic="data-flow"
    role="img"
    aria-label="Where your data goes: it stays in your systems, your automation runs on hosting we manage and belongs to you, and the AI provider reads only the part it needs and may not train on it. You hold the access and can take it back at any time."
>
    <div class="relative rounded-2xl border border-white/10 bg-navy-900/80 p-6 sm:p-8 shadow-2xl shadow-black/40 text-left" aria-hidden="true">
        <div class="flow-line w-px left-[2.72rem] sm:left-[3.22rem] top-[2.75rem] sm:top-[3.25rem] bottom-[6.5rem] sm:bottom-[7rem]"></div>

        <ol class="relative space-y-7">
            @foreach ($nodes as [$title, $detail, $icon, $style])
                <li class="flex items-start gap-4">
                    <span class="relative z-10 flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center {{ $style }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                    </span>
                    <div class="pt-1">
                        <p class="font-semibold text-white">{{ $title }}</p>
                        <p class="text-sm text-gray-400">{{ $detail }}</p>
                    </div>
                </li>
            @endforeach
        </ol>

        <div class="mt-7 flex items-center gap-3 rounded-xl border border-emerald-400/30 bg-emerald-400/10 px-4 py-3">
            <svg class="w-5 h-5 flex-shrink-0 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
            <p class="text-sm text-emerald-200">You hold the keys. Access can be taken back at any time.</p>
        </div>
    </div>
</figure>
