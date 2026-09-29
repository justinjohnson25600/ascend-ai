@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    // Bar lengths are illustrative shapes only; no figures are shown.
    $rows = [
        [1, 'Jobs booked', 'w-[74%]', 'bg-accent-400'],
        [2, 'Quotes waiting', 'w-[38%]', 'bg-purple-400'],
        [3, 'Cash due in', 'w-[56%]', 'bg-emerald-400'],
        [4, 'Hours by person', 'w-[82%]', 'bg-sky-300'],
    ];
@endphp
<x-vignettes.frame
    name="report"
    title="Your week · Monday 07:00"
    :steps="5"
    label="the numbers the owner runs the business on are pulled together and sent to their inbox every Monday morning."
>
    <p class="text-sm font-semibold text-white mb-4">This week at a glance</p>

    <div class="space-y-4">
        @foreach ($rows as [$step, $label, $width, $colour])
            <div>
                <p class="text-xs text-gray-400 mb-1.5">{{ $label }}</p>
                <div class="h-2.5 rounded-full bg-white/5 overflow-hidden">
                    <div class="vig-bar h-full rounded-full {{ $colour }}" :class="at({{ $step }}) ? '{{ $width }}' : 'w-0'"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="vig-item mt-6" :class="{!! $s(5) !!}">
        <span class="vig-chip">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Sent to your inbox
        </span>
    </div>
</x-vignettes.frame>
