@php $s = fn (int $n): string => "at($n) ? 'vig-on' : 'vig-off'"; @endphp
<x-vignettes.frame
    name="lesson"
    title="Quote replies"
    :steps="5"
    label="the owner adds a line to a drafted quote reply; the agent writes it into its playbook as a lesson, and the next quote it drafts already includes the line and is approved without changes."
>
    <div class="vig-item rounded-xl border border-white/10 bg-navy-800/80 p-2.5" :class="{!! $s(1) !!}">
        <div class="flex items-center justify-between gap-2 mb-1">
            <p class="text-[10px] uppercase tracking-wider text-gray-500 truncate">Draft · Mrs Patel, new patio</p>
            <span class="flex-shrink-0 text-[10px] font-medium rounded-full border px-2 py-0.5 transition-colors duration-500" :class="at(2) ? 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30' : 'text-gray-300 bg-white/5 border-white/10'" x-text="at(2) ? 'Edited by you' : 'Waiting for you'"></span>
        </div>
        <p class="text-xs text-gray-200">We can do it for £1,850 including materials.</p>
        <p class="vig-item mt-1 border-l-2 border-emerald-400/60 pl-2 text-xs text-emerald-300" :class="{!! $s(2) !!}">And we take all the waste away.</p>
    </div>

    <div class="vig-item my-1.5 flex items-start gap-2 rounded-xl border border-purple-400/30 bg-purple-400/10 p-2.5" :class="{!! $s(3) !!}">
        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        <div>
            <p class="text-[10px] uppercase tracking-wider text-purple-300">Lesson added to your playbook</p>
            <p class="text-xs text-gray-100">Patio quotes: say waste removal is included.</p>
        </div>
    </div>

    <div class="vig-item rounded-xl border border-white/10 bg-navy-800/80 p-2.5" :class="{!! $s(4) !!}">
        <div class="flex items-center justify-between gap-2 mb-1">
            <p class="text-[10px] uppercase tracking-wider text-gray-500 truncate">Draft · Mr Hughes, patio</p>
            <span class="flex-shrink-0 text-[10px] font-medium rounded-full border px-2 py-0.5 text-purple-300 bg-purple-400/10 border-purple-400/30">Learned from you</span>
        </div>
        <p class="text-xs text-gray-200">We can do it for £2,200 including materials. <span class="text-emerald-300">And we take all the waste away.</span></p>
    </div>

    <div class="vig-item mt-1.5" :class="{!! $s(5) !!}">
        <span class="vig-chip">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Approved without changes
        </span>
    </div>
</x-vignettes.frame>
