@php
    $events = [
        ['06:58', 'A new enquiry from your website gets a reply, three questions answered, and a booking link.', 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
        ['08:14', 'You miss a call on the way to a job. The caller gets a text within a minute and books Friday.', 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
        ['10:30', "Yesterday's quote gets its first friendly nudge.", 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ['12:05', 'Three receipts you photographed on site are in the accounts, matched to the bank.', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ['15:40', "A customer moves Thursday's appointment themselves. Your diary updates.", 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['18:00', "Tomorrow's customers get their reminder.", 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
        ['21:15', 'Someone asks your website chat whether you cover Basildon. It answers, and texts you because they want a quote.', 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
    ];
@endphp
<section class="texture-glow divider-top bg-navy-900 py-20 lg:py-32 relative overflow-hidden">
    <div class="container">
        <x-ui.section-heading
            title="A day in your business, with the admin handled"
            subtitle="An example day. Everything below happens while you are doing the work you are actually paid for."
            alignment="center"
            class="reveal-up"
        />

        <div class="relative max-w-4xl mx-auto">
            <div class="flow-line w-px left-5 lg:left-1/2 top-4 bottom-4" aria-hidden="true"></div>

            <ol class="relative space-y-6">
                @foreach ($events as $i => [$time, $text, $icon])
                    <li class="reveal-up relative pl-14 lg:pl-0 lg:grid lg:grid-cols-2 lg:gap-16">
                        <span class="absolute left-5 lg:left-1/2 -translate-x-1/2 top-3 z-10 w-10 h-10 rounded-full flex items-center justify-center {{ $i === count($events) - 1 ? 'bg-accent-500 text-white shadow-lg shadow-accent-500/30' : 'bg-navy-800 border border-accent-400/30 text-accent-300' }}" aria-hidden="true">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                        </span>
                        <div class="{{ $i % 2 === 0 ? 'lg:col-start-1 lg:text-right' : 'lg:col-start-2' }}">
                            <div class="card-glass p-5">
                                <p class="text-accent-300 font-semibold tabular-nums mb-1"><time>{{ $time }}</time></p>
                                <p class="text-gray-200">{{ $text }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>

        <p class="text-center mt-14 text-2xl md:text-3xl font-bold gradient-text reveal-up">And you did none of it.</p>
    </div>
</section>
