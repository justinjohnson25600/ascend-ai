@php
    // Six areas placed around a central node: label, x and y as percentages of the square, the same position as literal Tailwind classes, icon path.
    $nodes = [
        ['Enquiries', 50, 15, 'left-[50%] top-[15%]', 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
        ['Quotes', 80.3, 32.5, 'left-[80.3%] top-[32.5%]', 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ['Diary', 80.3, 67.5, 'left-[80.3%] top-[67.5%]', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['Reporting', 50, 85, 'left-[50%] top-[85%]', 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
        ['Paperwork', 19.7, 67.5, 'left-[19.7%] top-[67.5%]', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ['Questions', 19.7, 32.5, 'left-[19.7%] top-[32.5%]', 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
    ];
    $delays = ['[animation-delay:0s]', '[animation-delay:-0.45s]', '[animation-delay:-0.9s]', '[animation-delay:-1.35s]', '[animation-delay:-1.8s]', '[animation-delay:-2.25s]'];
@endphp
<figure
    class="relative w-full max-w-md mx-auto aspect-square"
    data-graphic="hub"
    role="img"
    aria-label="The six areas we automate, enquiries, quotes, diary, reporting, paperwork and customer questions, all connected to one system."
>
    <div class="absolute inset-0" aria-hidden="true">
        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 400" fill="none">
            <circle cx="200" cy="200" r="140" class="hub-line" stroke-dasharray="3 7" />
            @foreach ($nodes as $i => [$label, $x, $y])
                <line x1="200" y1="200" x2="{{ $x * 4 }}" y2="{{ $y * 4 }}" class="hub-line" />
                <path d="M200 200 L{{ $x * 4 }} {{ $y * 4 }}" class="hub-pulse {{ $delays[$i] }}" />
            @endforeach
        </svg>

        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-28 h-28 rounded-2xl border border-accent-400/40 bg-navy-900/95 shadow-2xl shadow-accent-500/20 flex flex-col items-center justify-center text-center">
            <span class="text-lg font-bold tracking-wide text-white">ASCEND</span>
            <span class="mt-1 text-[11px] font-semibold text-accent-300 border border-accent-400/60 rounded px-1.5">AI</span>
        </div>

        @foreach ($nodes as [$label, $x, $y, $position, $icon])
            <div class="absolute -translate-x-1/2 -translate-y-1/2 {{ $position }}">
                <span class="w-14 h-14 rounded-full border border-white/10 bg-navy-800/95 shadow-lg shadow-black/40 flex items-center justify-center text-accent-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                </span>
                <span class="absolute top-full left-1/2 -translate-x-1/2 mt-1.5 text-xs font-medium text-gray-300 whitespace-nowrap">{{ $label }}</span>
            </div>
        @endforeach
    </div>
</figure>
