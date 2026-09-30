@php $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'"; @endphp
<x-vignettes.frame
    name="table-booking"
    title="Messages · Friday 21:40"
    :steps="5"
    label="late on a Friday a customer asks for a birthday table for six; it is booked, dietary needs are taken, and the booking and kitchen notes are updated."
>
    <div class="space-y-2">
        <div class="vig-item vig-bubble-out" :class="{!! $s(1) !!}">Table for 6 tomorrow at 7? It's a birthday.</div>

        <div x-show="step === 2" x-transition.opacity class="vig-typing mr-auto inline-flex gap-1 rounded-2xl rounded-bl-sm bg-navy-700 px-3 py-2.5">
            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
        </div>

        <div class="vig-item vig-bubble-in" :class="{!! $s(3) !!}">Happy birthday to them! 7pm for 6 is booked. Any dietary needs we should know about?</div>
        <div class="vig-item vig-bubble-out" :class="{!! $s(4) !!}">One vegan, one nut allergy.</div>
        <div class="vig-item vig-bubble-in" :class="{!! $s(5) !!}">Noted on your booking. See you tomorrow.</div>
        <div class="vig-item pt-1" :class="{!! $s(5) !!}">
            <span class="vig-chip">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Booking diary and kitchen notes updated
            </span>
        </div>
    </div>
</x-vignettes.frame>
