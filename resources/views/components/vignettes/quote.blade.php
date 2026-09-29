@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    $timeline = [
        [1, 'Monday', 'Quote sent'],
        [2, 'Thursday', 'Friendly nudge sent'],
        [3, 'Next Tuesday', 'Second nudge sent'],
        [4, 'Wednesday', 'Accepted by the customer'],
    ];
@endphp
<x-vignettes.frame
    name="quote"
    title="Quotes"
    :steps="5"
    label="a quote is sent and chased politely twice until the customer accepts it, then the invoice is lined up for when the job is done."
>
    <div class="vig-item rounded-xl border border-white/10 bg-navy-800/80 p-3 mb-3" :class="{!! $s(1) !!}">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="text-[11px] uppercase tracking-wider text-gray-500">Quote Q-1042</p>
                <p class="text-sm font-semibold text-white">Kitchen rewire</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-white">£2,340</p>
                <span class="text-[10px] font-medium rounded-full border px-2 py-0.5 transition-colors duration-500" :class="at(4) ? 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30' : 'text-gray-300 bg-white/5 border-white/10'" x-text="at(4) ? 'Accepted' : 'Awaiting reply'"></span>
            </div>
        </div>
    </div>

    <ol class="relative ml-2 border-l border-white/10 space-y-2">
        @foreach ($timeline as [$step, $when, $what])
            <li class="vig-item relative pl-5" :class="{!! $s($step) !!}">
                <span class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full {{ $step === 4 ? 'bg-emerald-400' : 'bg-accent-400' }}"></span>
                <p class="text-[11px] text-gray-500">{{ $when }}</p>
                <p class="text-xs {{ $step === 4 ? 'text-emerald-300 font-medium' : 'text-gray-200' }}">{{ $what }}</p>
            </li>
        @endforeach
    </ol>

    <div class="vig-item mt-3" :class="{!! $s(5) !!}">
        <span class="vig-chip">Invoice goes out when the job is marked done</span>
    </div>
</x-vignettes.frame>
