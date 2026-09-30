@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    // Each suggestion: the step it arrives on, what the agent noticed, what it suggests, and whether the owner approves it.
    $suggestions = [
        [1, 'Quotes over £2,000 often go quiet after the first nudge.', 'remind you to call on day five.', true],
        [2, 'Parking came up in 9 enquiries this month.', 'add the answer to your website.', true],
        [3, 'Tuesday mornings are often empty.', 'offer Tuesday slots first.', false],
    ];
@endphp
<x-vignettes.frame
    name="suggestions"
    title="Suggestions · Friday 16:00"
    :steps="5"
    label="at the end of the week the agent suggests three changes with its reasons; the owner approves two and turns one down, and the approved changes go live on Monday."
>
    <div class="space-y-1.5">
        @foreach ($suggestions as [$arrives, $noticed, $suggest, $approved])
            <div class="vig-item rounded-xl border border-white/5 bg-navy-800/70 p-2.5" :class="{!! $s($arrives) !!}">
                <div class="flex items-start justify-between gap-2">
                    <p class="text-xs text-white">{{ $noticed }}</p>
                    <span class="vig-item flex-shrink-0 text-[10px] font-medium rounded-full border px-2 py-0.5 {{ $approved ? 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30' : 'text-gray-300 bg-white/5 border-white/10' }}" :class="{!! $s(4) !!}">{{ $approved ? 'Approved' : 'Not now' }}</span>
                </div>
                <p class="mt-1 flex items-start gap-1.5 text-[11px] text-accent-300">
                    <svg class="w-3.5 h-3.5 mt-px flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    <span>Suggest: {{ $suggest }}</span>
                </p>
            </div>
        @endforeach
    </div>

    <div class="vig-item mt-2" :class="{!! $s(5) !!}">
        <span class="vig-chip">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Two changes live from Monday
        </span>
    </div>
</x-vignettes.frame>
