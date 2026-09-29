@php
    $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'";
    $emails = [
        ['S', 'Sam P.', 'Boiler making that noise again, can you come Tuesday?', 1, 'Important', 4, 'text-amber-200 bg-amber-400/15 border-amber-400/30'],
        ['P', 'Parts Supplier', 'Invoice 4471 attached', 2, 'Filed', 3, 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30'],
        ['D', 'D. Khan', 'What time do you open on Saturday?', 2, 'Answered', 3, 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30'],
    ];
@endphp
<x-vignettes.frame
    name="email"
    title="Inbox"
    :steps="5"
    label="three emails arrive; the question is answered, the invoice is filed, and the new enquiry is sent to your phone by text."
>
    <div class="space-y-2">
        @foreach ($emails as $i => [$initial, $from, $subject, $arrives, $tag, $tagged, $tagClass])
            <div
                class="vig-item flex items-start gap-3 rounded-xl border border-white/5 bg-navy-800/70 p-3"
                :class="[{!! $s($arrives) !!}, {{ $i === 0 ? "at(4) ? 'ring-1 ring-amber-400/50' : ''" : "''" }}]"
            >
                <span class="flex-shrink-0 w-7 h-7 rounded-full bg-slate-600 text-gray-200 text-xs font-semibold flex items-center justify-center">{{ $initial }}</span>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-xs font-semibold text-white truncate">{{ $from }}</p>
                        <span class="vig-item flex-shrink-0 text-[10px] font-medium rounded-full border px-2 py-0.5 {{ $tagClass }}" :class="{!! $s($tagged) !!}">{{ $tag }}</span>
                    </div>
                    <p class="text-xs text-gray-400 truncate">{{ $subject }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="vig-item absolute left-4 right-4 bottom-4 rounded-2xl border border-accent-400/30 bg-navy-700/95 p-3 shadow-xl shadow-black/40" :class="{!! $s(5) !!}">
        <div class="flex items-center gap-2 mb-1">
            <svg class="w-4 h-4 text-accent-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            <p class="text-[11px] uppercase tracking-wider text-accent-300">Text to your phone</p>
        </div>
        <p class="text-xs text-gray-100">New enquiry from Sam P. Boiler service, wants Tuesday. Tap to reply.</p>
    </div>
</x-vignettes.frame>
