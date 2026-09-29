@props(['compact' => false])
@php
    // A drawn example of the written audit (CONTENT_BLUEPRINT_V2 item 13). Placeholder lines stand in for text; no real figures.
    $line = 'h-2 rounded-full bg-gray-200';
@endphp
<figure
    {{ $attributes->class(['relative mx-auto w-full', 'max-w-sm' => $compact, 'max-w-md' => ! $compact]) }}
    data-graphic="audit-preview"
    role="img"
    aria-label="An example layout of the written audit: how your business runs today, where the hours go, what we would automate first, what each would involve, and a rough cost range."
>
    <div aria-hidden="true">
        {{-- A second sheet behind, for depth --}}
        <div class="absolute inset-0 translate-x-3 translate-y-3 rotate-2 rounded-xl bg-gray-300/80 shadow-xl"></div>

        <div class="relative -rotate-1 rounded-xl bg-gray-50 text-gray-800 shadow-2xl shadow-black/50 {{ $compact ? 'p-5' : 'p-7' }} text-left">
            <div class="flex items-start justify-between gap-3 mb-5">
                <div>
                    <p class="text-[10px] font-bold tracking-[0.2em] text-gray-500">ASCEND <span class="text-sky-600">AI</span></p>
                    <p class="{{ $compact ? 'text-base' : 'text-xl' }} font-bold text-gray-900">Automation audit</p>
                    <p class="text-xs text-gray-500">Prepared for: Your business</p>
                </div>
                <span class="text-[10px] uppercase tracking-wider text-sky-700 bg-sky-100 border border-sky-200 rounded-full px-2 py-0.5 whitespace-nowrap">Example layout</span>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-xs font-bold text-gray-900 mb-2">1. How your business runs today</p>
                    <div class="space-y-1.5"><div class="{{ $line }} w-full"></div><div class="{{ $line }} w-11/12"></div>@unless ($compact)<div class="{{ $line }} w-3/4"></div>@endunless</div>
                </div>

                <div>
                    <p class="text-xs font-bold text-gray-900 mb-2">2. Where the hours go</p>
                    <div class="space-y-1.5">
                        @foreach (['w-4/5 bg-sky-500', 'w-3/5 bg-sky-400', 'w-2/5 bg-violet-400', 'w-1/4 bg-violet-300'] as $bar)
                            <div class="flex items-center gap-2"><div class="{{ $line }} w-14 flex-shrink-0"></div><div class="h-2.5 rounded {{ $bar }}"></div></div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <p class="text-xs font-bold text-gray-900 mb-2">3. What we would automate first</p>
                    <div class="space-y-2">
                        @foreach (['w-10/12', 'w-9/12', 'w-8/12'] as $n => $width)
                            <div class="flex items-center gap-2">
                                <span class="w-4 h-4 flex-shrink-0 rounded-full bg-sky-600 text-[9px] font-bold text-white flex items-center justify-center">{{ $n + 1 }}</span>
                                <div class="{{ $line }} {{ $width }}"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @unless ($compact)
                    <div>
                        <p class="text-xs font-bold text-gray-900 mb-2">4. What each would involve</p>
                        <div class="space-y-1.5"><div class="{{ $line }} w-full"></div><div class="{{ $line }} w-5/6"></div></div>
                    </div>
                @endunless

                <div class="flex items-center justify-between gap-3 rounded-lg bg-white border border-gray-200 px-3 py-2">
                    <p class="text-xs font-bold text-gray-900">{{ $compact ? '4' : '5' }}. Rough cost range</p>
                    <div class="flex items-center gap-1.5 text-xs text-gray-500">£ <span class="inline-block w-10 h-2.5 rounded bg-gray-300"></span> to £ <span class="inline-block w-10 h-2.5 rounded bg-gray-300"></span></div>
                </div>
            </div>
        </div>
    </div>
</figure>
