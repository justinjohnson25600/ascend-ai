@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    // Each check: the step it appears on, whether it passed, and what it found. Illustrative; £1,236 is 20% of £6,180 of labour.
    $checks = [
        [1, true, 'Five subcontractor payments this month'],
        [2, true, 'CIS deductions add up: £1,236.00'],
        [3, false, 'J. Barker has not been verified with HMRC'],
        [4, false, 'Invoice 2291 is missing the reverse charge wording'],
    ];
@endphp
<x-vignettes.frame
    name="pre-check"
    title="Checks before you submit · 15 October"
    :steps="5"
    label="before the monthly CIS return is due, the records are checked; two things pass, two need fixing, and the list goes to the owner and their accountant."
>
    <ul class="space-y-2">
        @foreach ($checks as [$step, $passed, $text])
            <li class="vig-item flex items-start gap-2.5 rounded-xl border px-3 py-2.5 {{ $passed ? 'border-white/5 bg-navy-800/70' : 'border-amber-400/30 bg-amber-400/10' }}" :class="{!! $s($step) !!}">
                @if ($passed)
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                @else
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                @endif
                <span class="text-xs {{ $passed ? 'text-gray-200' : 'text-amber-100' }}">{{ $text }}</span>
            </li>
        @endforeach
    </ul>

    <div class="vig-item mt-3" :class="{!! $s(5) !!}">
        <span class="vig-chip">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Two to fix before the 19th. Sent to you and your accountant.
        </span>
    </div>
</x-vignettes.frame>
