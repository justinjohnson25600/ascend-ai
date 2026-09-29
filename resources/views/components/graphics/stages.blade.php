@php
    $stages = [
        ['Free audit', 'A 30 minute call and a written list', 'Free', 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30'],
        ['Scope and setup', 'Access, hosting and the detailed plan', 'Setup fee', 'text-gray-200 bg-white/5 border-white/15'],
        ['Stage 1 live', 'Built, tested with your data, switched on', 'Fixed price', 'text-accent-300 bg-accent-500/10 border-accent-400/30'],
        ['Stage 2 live', 'Only when you are ready for it', 'Fixed price', 'text-accent-300 bg-accent-500/10 border-accent-400/30'],
        ['Run and improve', 'Hosted, monitored and kept up to date', 'Monthly', 'text-purple-300 bg-purple-400/10 border-purple-400/30'],
    ];
@endphp
<figure
    class="relative w-full max-w-md mx-auto"
    data-graphic="stages"
    role="img"
    aria-label="How a project runs: a free audit, then scope and setup for a setup fee, then stages that each go live for a fixed price, then a monthly fee to run and improve it."
>
    <div class="relative rounded-2xl border border-white/10 bg-navy-900/80 p-6 shadow-2xl shadow-black/40 text-left" aria-hidden="true">
        <div class="flow-line w-px left-[2.2rem] top-[2.6rem] bottom-[2.6rem]"></div>

        <ol class="relative space-y-3">
            @foreach ($stages as $i => [$title, $detail, $fee, $feeClass])
                <li class="flex items-center gap-4 rounded-xl border border-white/5 bg-navy-800/60 py-3 pl-2 pr-3">
                    <span class="relative z-10 flex-shrink-0 w-5 h-5 rounded-full border-2 {{ $i === 0 ? 'border-emerald-400 bg-emerald-400' : 'border-accent-400 bg-navy-900' }}"></span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-white">{{ $title }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $detail }}</p>
                    </div>
                    <span class="flex-shrink-0 text-[11px] font-medium rounded-full border px-2.5 py-0.5 {{ $feeClass }}">{{ $fee }}</span>
                </li>
            @endforeach
        </ol>
    </div>
</figure>
