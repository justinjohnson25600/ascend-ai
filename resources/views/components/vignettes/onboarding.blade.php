@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    // Each step of taking on a new client: the step it appears on and what happened.
    $steps = [
        [1, 'Enquiry qualified: budget and timing fit'],
        [2, 'Discovery call booked for Tuesday 10:00'],
        [3, 'Agreement sent for signature, and signed'],
        [4, 'Project folder and intake form set up'],
    ];
@endphp
<x-vignettes.frame
    name="onboarding"
    title="New client · Harper & Co"
    :steps="5"
    label="a new enquiry is qualified, a discovery call is booked, the agreement is signed, the project folder and intake form are set up, and the first invoice is scheduled."
>
    <ol class="relative ml-2 border-l border-white/10 space-y-3">
        @foreach ($steps as [$step, $text])
            <li class="vig-item relative pl-5" :class="{!! $s($step) !!}">
                <span class="absolute -left-[7px] top-0.5 w-3.5 h-3.5 rounded-full bg-emerald-400/20 border border-emerald-400/60 flex items-center justify-center">
                    <svg class="w-2.5 h-2.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </span>
                <p class="text-xs text-gray-200">{{ $text }}</p>
            </li>
        @endforeach
    </ol>

    <div class="vig-item mt-4 rounded-xl border border-white/10 bg-navy-800/80 p-3" :class="{!! $s(4) !!}">
        <p class="text-[10px] uppercase tracking-wider text-gray-500 mb-1">Intake form</p>
        <div class="space-y-1.5">
            <div class="h-1.5 w-4/5 rounded-full bg-white/10"></div>
            <div class="h-1.5 w-3/5 rounded-full bg-white/10"></div>
            <div class="h-1.5 w-2/3 rounded-full bg-white/10"></div>
        </div>
    </div>

    <div class="vig-item mt-3" :class="{!! $s(5) !!}">
        <span class="vig-chip">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            First invoice scheduled for the 1st
        </span>
    </div>
</x-vignettes.frame>
