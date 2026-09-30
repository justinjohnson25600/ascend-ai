@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    // Illustrative and internally consistent: £18,400 quoted for a 21% margin; materials 14% and labour 4 days over leave 6%.
    $lines = [
        [1, 'Materials', 'Quoted £6,200', 'Actual £7,050', 'w-[88%]', 'w-full'],
        [2, 'Labour', 'Quoted 18 days', 'Actual 22 days', 'w-[82%]', 'w-full'],
    ];
@endphp
<x-vignettes.frame
    name="job-review"
    title="Job review · Elm Road extension"
    :steps="5"
    label="after a job, the quote is compared with what it really cost; materials and labour ran over, the margin fell from 21% to 6%, and a pricing lesson for similar jobs is suggested and approved."
>
    <div class="space-y-3">
        @foreach ($lines as [$step, $label, $quoted, $actual, $quotedWidth, $actualWidth])
            <div class="vig-item" :class="{!! $s($step) !!}">
                <div class="flex items-center justify-between text-[11px] mb-1">
                    <span class="font-medium text-white">{{ $label }}</span>
                    <span class="text-gray-400">{{ $quoted }} · <span class="text-amber-200">{{ $actual }}</span></span>
                </div>
                <div class="h-2 rounded-full bg-white/5 overflow-hidden mb-1">
                    <div class="vig-bar h-full rounded-full bg-accent-400" :class="at({{ $step }}) ? '{{ $quotedWidth }}' : 'w-0'"></div>
                </div>
                <div class="h-2 rounded-full bg-white/5 overflow-hidden">
                    <div class="vig-bar h-full rounded-full bg-amber-400" :class="at({{ $step }}) ? '{{ $actualWidth }}' : 'w-0'"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="vig-item mt-3 flex items-center justify-between rounded-xl border border-amber-400/30 bg-amber-400/10 px-3 py-2" :class="{!! $s(3) !!}">
        <span class="text-xs text-amber-100">Margin on £18,400</span>
        <span class="text-xs font-semibold text-amber-200">Planned 21% · actual 6%</span>
    </div>

    <div class="vig-item mt-2 flex items-start gap-2 rounded-xl border border-purple-400/30 bg-purple-400/10 p-2.5" :class="{!! $s(4) !!}">
        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        <div>
            <p class="text-[10px] uppercase tracking-wider text-purple-300">Pricing lesson, for your approval</p>
            <p class="text-xs text-gray-100">Extensions with groundwork: allow 22% more labour and 14% more for materials.</p>
        </div>
    </div>

    <div class="vig-item mt-2" :class="{!! $s(5) !!}">
        <span class="vig-chip">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Approved. Your next extension quote uses it.
        </span>
    </div>
</x-vignettes.frame>
