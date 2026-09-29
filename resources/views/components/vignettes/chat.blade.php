@php $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'"; @endphp
<x-vignettes.frame
    name="chat"
    title="Chat on your website · 21:47"
    :steps="5"
    label="a visitor asks a question late in the evening, gets an accurate answer, books a slot, and the owner is sent a text."
>
    <div class="space-y-2">
        <div class="vig-item vig-bubble-out" :class="{!! $s(1) !!}">Do you cover Basildon? How soon could you come out?</div>

        <div x-show="step === 2" x-transition.opacity class="vig-typing mr-auto inline-flex gap-1 rounded-2xl rounded-bl-sm bg-navy-700 px-3 py-2.5">
            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
        </div>

        <div class="vig-item vig-bubble-in" :class="{!! $s(3) !!}">Yes, we cover Basildon and the rest of south Essex. Our next free slots are Tuesday and Thursday morning. Shall I book one?</div>
        <div class="vig-item vig-bubble-out" :class="{!! $s(4) !!}">Thursday please.</div>
        <div class="vig-item vig-bubble-in" :class="{!! $s(5) !!}">Done. You'll get a confirmation by text.</div>
        <div class="vig-item pt-1" :class="{!! $s(5) !!}">
            <span class="vig-chip">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Sent to the owner by text
            </span>
        </div>
    </div>
</x-vignettes.frame>
