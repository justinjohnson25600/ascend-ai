@php $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'"; @endphp
<x-vignettes.frame
    name="missed-call"
    title="Your phone"
    :steps="6"
    label="a missed call gets an automatic text back, the customer replies, and a slot is booked while you are on a job."
>
    <div class="space-y-2">
        <div class="vig-item flex items-center gap-3 rounded-xl border border-red-500/25 bg-red-500/10 px-3 py-2" :class="{!! $s(1) !!}">
            <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z"/></svg>
            <div>
                <p class="text-xs font-medium text-red-300">Missed call</p>
                <p class="text-xs text-gray-400">07700 900123 · 08:14</p>
            </div>
        </div>
        <div class="vig-item vig-bubble-out" :class="{!! $s(2) !!}">Sorry we missed you, we're on a job. What can we help with?</div>
        <div class="vig-item vig-bubble-in" :class="{!! $s(3) !!}">Leaking tap in the kitchen, any chance this week?</div>
        <div class="vig-item vig-bubble-out" :class="{!! $s(4) !!}">We can do Wednesday 2pm or Friday 9am. Which suits?</div>
        <div class="vig-item vig-bubble-in" :class="{!! $s(5) !!}">Friday 9am</div>
        <div class="vig-item pt-1" :class="{!! $s(6) !!}">
            <span class="vig-chip">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Booked. Summary sent to you.
            </span>
        </div>
    </div>
</x-vignettes.frame>
