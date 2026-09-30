@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    // Each row: the step it lands on, where it came from, what it was, and where it went.
    $rows = [
        [3, 'Spreadsheet', 'Fuel, £62.00', 'Filed · van costs'],
        [4, 'Email', 'Plumbing supplies, £212.40', 'Filed · matched to bank'],
    ];
@endphp
<x-vignettes.frame
    name="receipts-in"
    title="Receipts · this week"
    :steps="5"
    label="a receipt texted from site, a line from a spreadsheet and an emailed invoice are all read and filed into the accounts, and a card payment with no receipt is flagged."
>
    <div class="space-y-1.5">
        <div class="vig-item vig-bubble-out flex items-center gap-2" :class="{!! $s(1) !!}">
            <span class="flex-shrink-0 w-6 h-8 rounded bg-white/90 flex flex-col justify-center gap-0.5 px-1" aria-hidden="true">
                <span class="h-0.5 rounded bg-slate-400"></span>
                <span class="h-0.5 rounded bg-slate-300"></span>
                <span class="h-0.5 rounded bg-slate-400"></span>
                <span class="h-0.5 w-2/3 rounded bg-slate-500"></span>
            </span>
            <span>Merchant receipt for Elm Road</span>
        </div>

        <div class="vig-item vig-bubble-in" :class="{!! $s(2) !!}">Builders' merchant, £84.60 including £14.10 VAT. Filed under materials for Elm Road.</div>

        @foreach ($rows as [$step, $source, $what, $where])
            <div class="vig-item flex items-center justify-between gap-2 rounded-xl border border-white/5 bg-navy-800/70 px-3 py-2" :class="{!! $s($step) !!}">
                <div class="min-w-0">
                    <p class="text-[10px] uppercase tracking-wider text-gray-500">{{ $source }}</p>
                    <p class="text-xs text-white truncate">{{ $what }}</p>
                </div>
                <span class="flex-shrink-0 text-[10px] font-medium rounded-full border px-2 py-0.5 text-emerald-300 bg-emerald-400/10 border-emerald-400/30">{{ $where }}</span>
            </div>
        @endforeach
    </div>

    <div class="vig-item mt-1.5" :class="{!! $s(5) !!}">
        <span class="vig-chip-warn">A £48.20 card payment on 22 September has no receipt. Text a photo when you can.</span>
    </div>
</x-vignettes.frame>
