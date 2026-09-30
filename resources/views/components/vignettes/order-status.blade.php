@php $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'"; @endphp
<x-vignettes.frame
    name="order-status"
    title="Chat on your shop · 23:12"
    :steps="5"
    label="late at night a customer asks where their order is and whether they can return it; both are answered from the shop's own systems and policy, and low stock is flagged for reordering."
>
    <div class="space-y-2">
        <div class="vig-item vig-bubble-out" :class="{!! $s(1) !!}">Where's my order? It's #10582.</div>
        <div class="vig-item vig-bubble-in" :class="{!! $s(2) !!}">It left us yesterday and arrives on Thursday. Here's your tracking link.</div>
        <div class="vig-item vig-bubble-out" :class="{!! $s(3) !!}">Can I send it back if it doesn't fit?</div>
        <div class="vig-item vig-bubble-in" :class="{!! $s(4) !!}">Yes, within 30 days. I've emailed you a returns label, just in case.</div>
        <div class="vig-item pt-1" :class="{!! $s(5) !!}">
            <span class="vig-chip-warn">Low stock: that jacket in medium has 2 left. Added to your reorder list.</span>
        </div>
    </div>
</x-vignettes.frame>
