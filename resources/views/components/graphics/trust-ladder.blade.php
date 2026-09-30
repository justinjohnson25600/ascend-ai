@php
    // Each step: title, detail, how many of the three meter segments are lit, the tag and its colours.
    $steps = [
        ['It drafts, you send', 'Where every job starts', 1, 'Start here', 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30'],
        ['It sends the routine ones', 'You still see everything', 2, 'Your call', 'text-accent-300 bg-accent-500/10 border-accent-400/30'],
        ['It handles the job', 'And tells you what matters', 3, 'Your call', 'text-accent-300 bg-accent-500/10 border-accent-400/30'],
    ];
@endphp
<figure
    class="relative w-full max-w-md mx-auto"
    data-graphic="trust-ladder"
    role="img"
    aria-label="How much an agent does on its own, in three steps: it drafts and you send; it sends the routine ones and you still see everything; it handles the job and tells you what matters. You move each job up, or back, whenever you like."
>
    <div class="relative rounded-2xl border border-white/10 bg-navy-900/80 p-6 shadow-2xl shadow-black/40 text-left" aria-hidden="true">
        <p class="text-[11px] uppercase tracking-wider text-gray-500 mb-4">How much it does on its own</p>

        <ol class="space-y-3">
            @foreach ($steps as $i => [$title, $detail, $lit, $tag, $tagClass])
                <li class="rounded-xl border border-white/5 bg-navy-800/60 p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-white">{{ $title }}</p>
                            <p class="text-xs text-gray-400">{{ $detail }}</p>
                        </div>
                        <span class="flex-shrink-0 text-[11px] font-medium rounded-full border px-2.5 py-0.5 {{ $tagClass }}">{{ $tag }}</span>
                    </div>
                    <div class="mt-3 grid grid-cols-3 gap-1.5">
                        @for ($segment = 1; $segment <= 3; $segment++)
                            <span class="h-1.5 rounded-full {{ $segment <= $lit ? ($i === 0 ? 'bg-emerald-400' : 'bg-accent-400') : 'bg-white/10' }}"></span>
                        @endfor
                    </div>
                </li>
            @endforeach
        </ol>

        <p class="mt-4 flex items-center gap-2 text-xs text-gray-300">
            <svg class="w-4 h-4 text-accent-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
            You move a job up, or back, whenever you like.
        </p>
    </div>
</figure>
