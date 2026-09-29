@php
    $steps = [
        ['You send the form', 'It takes a couple of minutes.'],
        ['We reply within one working day', 'A person reads every enquiry.'],
        ['A 30 minute call', 'About how your business runs.'],
        ['Your written audit', 'Within two working days of the call.'],
    ];
@endphp
<figure
    class="relative w-full max-w-md mx-auto"
    data-graphic="next-steps"
    role="img"
    aria-label="What happens next: you send the form, we reply within one working day, we have a 30 minute call, and you get your written audit within two working days of the call."
>
    <div class="relative rounded-2xl border border-white/10 bg-navy-900/80 p-6 sm:p-8 shadow-2xl shadow-black/40 text-left" aria-hidden="true">
        <p class="text-xs uppercase tracking-wider text-accent-300 mb-6">What happens next</p>
        <div class="flow-line w-px left-[2.72rem] sm:left-[3.22rem] top-[5.3rem] sm:top-[5.8rem] bottom-[2.75rem] sm:bottom-[3.25rem]"></div>

        <ol class="relative space-y-6">
            @foreach ($steps as $i => [$title, $detail])
                <li class="flex items-start gap-4">
                    <span class="relative z-10 flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $i === 3 ? 'bg-accent-500 text-white shadow-lg shadow-accent-500/30' : 'bg-navy-800 border border-accent-400/30 text-accent-300' }}">{{ $i + 1 }}</span>
                    <div class="pt-1.5">
                        <p class="font-semibold text-white">{{ $title }}</p>
                        <p class="text-sm text-gray-400">{{ $detail }}</p>
                    </div>
                </li>
            @endforeach
        </ol>

        <p class="mt-7 inline-flex items-center gap-2 rounded-full border border-emerald-400/30 bg-emerald-400/10 px-3 py-1 text-xs font-medium text-emerald-300">Free, and no obligation after it</p>
    </div>
</figure>
