@php
    // Copy approved in CONTENT_BLUEPRINT_V2, item 9.
    $urls = [
        'history' => route('assistant.history'),
        'message' => route('assistant.message'),
        'reset' => route('assistant.reset'),
    ];
    $greeting = 'Hi. Ask me anything about Ascend AI: what we automate, how it works or what it costs. I answer from this website, and if you would like to talk to a person I can pass your details to Justin.';
@endphp
<div x-data="assistantChat(@js($urls))" @keydown.escape.window="open && close()">
    {{-- Launcher --}}
    <button
        type="button"
        x-ref="launcher"
        x-show="!open"
        @click="toggle()"
        aria-haspopup="dialog"
        class="fixed bottom-4 right-4 z-40 btn btn-primary rounded-full pl-4 pr-5 py-3 shadow-xl shadow-black/40 flex items-center gap-2"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
        <span>Ask a question</span>
    </button>

    {{-- Chat panel --}}
    <section
        x-show="open"
        x-cloak
        x-transition.opacity
        role="dialog"
        aria-label="Ascend AI assistant"
        class="fixed z-50 inset-x-0 bottom-0 sm:inset-x-auto sm:bottom-4 sm:right-4 w-full sm:w-[24rem] h-[82vh] sm:h-[36rem] max-h-[calc(100vh-1rem)] flex flex-col rounded-t-2xl sm:rounded-2xl border border-white/10 bg-navy-900 shadow-2xl shadow-black/60"
    >
        <header class="flex items-start justify-between gap-3 px-5 py-4 border-b border-white/10">
            <div>
                <p class="font-semibold text-white">Ascend AI assistant</p>
                <p class="text-xs text-accent-300">An example of what we build</p>
            </div>
            <div class="flex items-center gap-1">
                <button type="button" @click="reset()" class="text-xs text-gray-400 hover:text-white px-2 py-1 rounded transition-colors">Start again</button>
                <button type="button" @click="close()" class="p-1.5 rounded text-gray-400 hover:text-white hover:bg-white/10 transition-colors" aria-label="Close the assistant">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </header>

        <div x-ref="log" class="flex-1 overflow-y-auto px-4 py-4 space-y-3" aria-live="polite">
            <div class="vig-bubble-in text-sm whitespace-pre-line">{{ $greeting }}</div>

            <template x-for="(entry, index) in messages" :key="index">
                <div class="text-sm whitespace-pre-line" :class="entry.role === 'user' ? 'vig-bubble-out' : 'vig-bubble-in'" x-text="entry.content"></div>
            </template>

            <div x-show="sending" class="vig-typing mr-auto inline-flex gap-1 rounded-2xl rounded-bl-sm bg-navy-700 px-3 py-2.5" aria-label="The assistant is typing">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
            </div>
        </div>

        <form @submit.prevent="send()" class="border-t border-white/10 p-3">
            <div class="flex items-end gap-2">
                <label for="assistant-input" class="sr-only">Your question</label>
                <textarea
                    id="assistant-input"
                    x-ref="input"
                    x-model="input"
                    rows="2"
                    maxlength="800"
                    placeholder="Type your question"
                    @keydown.enter="if (! $event.shiftKey) { $event.preventDefault(); send(); }"
                    class="flex-1 resize-none rounded-lg bg-navy-800 border border-navy-700 px-3 py-2 text-sm text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500"
                ></textarea>
                <button type="submit" :disabled="sending || input.trim() === ''" class="btn btn-primary px-4 py-2.5 text-sm disabled:opacity-50">Send</button>
            </div>
            <p class="mt-2 text-[11px] leading-snug text-gray-500">
                AI can make mistakes and only knows what is on this website. Please do not share sensitive personal details. How we handle chats is in our <a href="{{ route('privacy-policy') }}#chat" class="text-accent-400 hover:text-accent-300">Privacy Policy</a>.
            </p>
        </form>
    </section>
</div>
