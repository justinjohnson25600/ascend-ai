@php
    // Five steps clockwise round a circle of radius 140 in a 400 square, starting at the top: label, the position as literal Tailwind classes, icon path.
    $nodes = [
        ['Does the work', 'left-[50%] top-[15%]', 'M5 13l4 4L19 7'],
        ['Keeps a record', 'left-[83.3%] top-[39.2%]', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
        ['Learns from you', 'left-[70.6%] top-[78.3%]', 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
        ['Spots a better way', 'left-[29.4%] top-[78.3%]', 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
        ['You decide', 'left-[16.7%] top-[39.2%]', 'M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5'],
    ];

    // A chevron half way between each pair of steps, pointing the way round.
    $arrows = array_map(fn (int $degrees): array => [
        round(200 + 140 * cos(deg2rad($degrees)), 1),
        round(200 + 140 * sin(deg2rad($degrees)), 1),
        $degrees + 90,
    ], [-54, 18, 90, 162, 234]);
@endphp
<figure
    class="relative w-full max-w-md mx-auto aspect-square"
    data-graphic="learning-loop"
    role="img"
    aria-label="How an agent gets better, in a loop: it does the work, keeps a record, learns from your corrections, spots a better way, and you decide. What it learns is written into a playbook in plain English."
>
    <div class="absolute inset-0" aria-hidden="true">
        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 400" fill="none">
            <circle cx="200" cy="200" r="140" class="hub-line" stroke-dasharray="3 7" />
            <circle cx="200" cy="200" r="140" class="loop-pulse" transform="rotate(-90 200 200)" />
            <circle cx="200" cy="200" r="140" class="loop-pulse [animation-delay:-3.5s]" transform="rotate(-90 200 200)" />
            @foreach ($arrows as [$x, $y, $rotation])
                <path d="M-4 -5 L3 0 L-4 5" transform="translate({{ $x }} {{ $y }}) rotate({{ $rotation }})" stroke="rgba(125, 211, 252, 0.8)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            @endforeach
        </svg>

        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 sm:w-32 sm:h-32 rounded-2xl border border-purple-400/40 bg-navy-900/95 shadow-2xl shadow-purple-500/20 flex flex-col items-center justify-center text-center px-2 sm:px-3">
            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-purple-300 mb-1 sm:mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <span class="text-xs sm:text-sm font-bold text-white">Your playbook</span>
            <span class="hidden sm:block mt-1 text-[10px] leading-tight text-gray-400">What it has learned, in plain English</span>
        </div>

        @foreach ($nodes as $i => [$label, $position, $icon])
            <div class="absolute -translate-x-1/2 -translate-y-1/2 {{ $position }}">
                <span class="w-12 h-12 sm:w-14 sm:h-14 rounded-full flex items-center justify-center shadow-lg {{ $i === 4 ? 'bg-accent-500 text-white shadow-accent-500/30' : 'border border-white/10 bg-navy-800/95 text-accent-300 shadow-black/40' }}">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                </span>
                <span class="absolute top-full left-1/2 -translate-x-1/2 mt-1.5 text-xs font-medium text-gray-300 whitespace-nowrap">{{ $label }}</span>
            </div>
        @endforeach
    </div>
</figure>
