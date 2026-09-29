@php
    $steps = [
        ['Something happens', 'An email, a call, a receipt.', 'M13 10V3L4 14h7v7l9-11h-7z'],
        ['AI reads it', 'And works out what it is.', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
        ['It does the job', 'Replies, books, files, chases.', 'M5 13l4 4L19 7'],
        ['You hear about it', 'Only when it matters.', 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'],
    ];
@endphp
<figure
    class="relative w-full max-w-md mx-auto"
    data-graphic="flow"
    role="img"
    aria-label="How automation works: something happens, AI reads it and works out what it is, it does the job, and you hear about it only when it matters."
>
    <div class="relative rounded-2xl border border-white/10 bg-navy-900/80 p-6 sm:p-8 shadow-2xl shadow-black/40 text-left" aria-hidden="true">
        <div class="flow-line w-px left-[2.72rem] sm:left-[3.22rem] top-[2.75rem] sm:top-[3.25rem] bottom-[2.75rem] sm:bottom-[3.25rem]"></div>

        <ol class="relative space-y-7">
            @foreach ($steps as $i => [$title, $detail, $icon])
                <li class="flex items-start gap-4">
                    <span class="relative z-10 flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center {{ $i === 3 ? 'bg-accent-500 text-white shadow-lg shadow-accent-500/30' : 'bg-navy-800 border border-accent-400/30 text-accent-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                    </span>
                    <div class="pt-1.5">
                        <p class="font-semibold text-white">{{ $title }}</p>
                        <p class="text-sm text-gray-400">{{ $detail }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</figure>
