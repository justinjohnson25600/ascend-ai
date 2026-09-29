@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    $fields = [['Supplier', "Builders' merchant"], ['Date', '12 Sep 2026'], ['VAT', '£14.10'], ['Total', '£84.60']];
@endphp
<x-vignettes.frame
    name="receipt"
    title="Receipts to accounts"
    :steps="4"
    label="a photographed receipt is read, entered into the accounts and matched to the bank, and a card payment with no receipt is flagged."
>
    <div class="grid grid-cols-2 gap-3">
        <div class="vig-item rounded-lg bg-gray-100 text-gray-800 p-3 font-mono text-[10px] leading-relaxed shadow-lg" :class="{!! $s(1) !!}">
            <p class="font-bold text-center">BUILDERS' MERCHANT</p>
            <p class="text-center text-gray-500 mb-1.5">12/09/2026 07:42</p>
            <p class="flex justify-between"><span>15mm copper x3</span><span>42.00</span></p>
            <p class="flex justify-between"><span>Fittings</span><span>28.50</span></p>
            <p class="flex justify-between border-t border-dashed border-gray-400 mt-1.5 pt-1"><span>VAT</span><span>14.10</span></p>
            <p class="flex justify-between font-bold"><span>TOTAL</span><span>£84.60</span></p>
        </div>

        <div class="space-y-1.5">
            @foreach ($fields as [$label, $value])
                <div class="vig-item flex items-center justify-between gap-2 rounded-md border border-accent-400/20 bg-accent-500/10 px-2 py-1.5" :class="{!! $s(2) !!}">
                    <span class="text-[10px] uppercase tracking-wider text-accent-300">{{ $label }}</span>
                    <span class="text-[11px] text-white truncate">{{ $value }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <p class="mt-4 mb-1.5 text-[11px] uppercase tracking-wider text-gray-500">Accounts</p>
    <div class="space-y-1.5">
        <div class="vig-item flex items-center justify-between gap-2 rounded-md bg-navy-800/80 border border-white/5 px-2.5 py-2 text-[11px]" :class="{!! $s(3) !!}">
            <span class="text-gray-300">12 Sep · Materials</span>
            <span class="text-white font-medium">£84.60</span>
            <span class="text-emerald-300">Matched to bank</span>
        </div>
        <div class="vig-item" :class="{!! $s(4) !!}">
            <span class="vig-chip-warn">Card payment of £36.00 on 12 September has no receipt</span>
        </div>
    </div>
</x-vignettes.frame>
