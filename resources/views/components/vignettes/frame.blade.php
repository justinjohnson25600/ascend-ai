@props([
    'name',          // machine name, used by tests and styling hooks
    'label',         // plain-English description read by screen readers, after "Example: "
    'title',         // the window title shown in the frame
    'steps' => 5,    // number of frames in the story
])

{{-- Shared window for the "automation in action" examples. Everything inside is decorative; the label describes it. --}}
<figure
    {{ $attributes->class('w-full max-w-md mx-auto') }}
    x-data="vignette({{ (int) $steps }})"
    data-vignette="{{ $name }}"
    role="img"
    aria-label="Example: {{ $label }}"
>
    <div class="rounded-2xl border border-white/10 bg-navy-900/90 shadow-2xl shadow-black/40 overflow-hidden text-left" aria-hidden="true">
        <div class="flex items-center justify-between gap-3 px-4 py-2.5 border-b border-white/10 bg-navy-800/80">
            <div class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 rounded-full bg-white/15"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-white/15"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-white/15"></span>
            </div>
            <p class="text-xs font-medium text-gray-300 truncate">{{ $title }}</p>
            <span class="text-[10px] uppercase tracking-wider text-accent-300 bg-accent-500/10 border border-accent-500/30 rounded-full px-2 py-0.5">Example</span>
        </div>
        <div class="relative h-[19rem] overflow-hidden p-4">
            {{ $slot }}
        </div>
    </div>
</figure>
