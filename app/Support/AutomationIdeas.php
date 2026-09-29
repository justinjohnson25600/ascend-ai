<?php

declare(strict_types=1);

namespace App\Support;

/**
 * The automation ideas library (/automation-ideas). Copy approved in CONTENT_BLUEPRINT_V2, item 11.
 * Typical examples of work small businesses hand to automation, not claims about clients.
 */
final class AutomationIdeas
{
    /** @var array<string, string> */
    public const SECTORS = [
        'trades' => 'Trades',
        'clinics' => 'Clinics and salons',
        'agencies' => 'Agencies and consultancies',
        'hospitality' => 'Hospitality',
        'shops' => 'Shops and online',
    ];

    /** @var array<string, string> */
    public const AREAS = [
        'enquiries' => 'Enquiries',
        'quotes' => 'Quotes and invoices',
        'diary' => 'Diary',
        'questions' => 'Customer questions',
        'paperwork' => 'Paperwork',
        'reporting' => 'Reporting',
        'reviews' => 'Reviews and marketing',
        'team' => 'Team',
    ];

    /** Heroicons outline paths, one per job. */
    public const ICONS = [
        'enquiries' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
        'quotes' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        'diary' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
        'questions' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
        'paperwork' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
        'reporting' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        'reviews' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
        'team' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
    ];

    private const ALL = ['trades', 'clinics', 'agencies', 'hospitality', 'shops'];

    /**
     * @return list<array{area: string, title: string, summary: string, sectors: list<string>}>
     */
    public static function all(): array
    {
        $ideas = [
            ['enquiries', 'Instant reply to every enquiry', 'Web, email and social enquiries get a proper reply within a minute, in your words.', self::ALL],
            ['enquiries', 'Missed-call text back', 'A missed call gets a text within a minute asking what they need, then books them in.', ['trades', 'clinics', 'hospitality']],
            ['enquiries', 'Enquiry qualification', 'Asks the questions you would ask and tells you which enquiries are worth a call.', ['trades', 'agencies']],
            ['enquiries', 'Follow-up until there is an answer', 'Polite follow-ups until an enquiry becomes a booking or a clear no.', self::ALL],
            ['enquiries', 'Important enquiries by text', 'The enquiries that matter are texted to you with a summary the moment they arrive.', self::ALL],
            ['quotes', 'Quotes drafted from your price list', 'Your prices and past jobs turned into a quote for you to check and send.', ['trades', 'agencies']],
            ['quotes', 'Quote chasing', 'Friendly nudges on the schedule you set, until the customer answers.', ['trades', 'agencies']],
            ['quotes', 'Invoice when the job is done', 'Marking a job done raises the invoice in your accounts software and sends it.', ['trades', 'agencies']],
            ['quotes', 'Overdue invoice nudges', 'Late payers get polite, escalating reminders without you writing them.', self::ALL],
            ['quotes', 'Deposits before confirming', 'Bookings over a set value ask for a deposit before they are confirmed.', ['clinics', 'hospitality', 'trades']],
            ['diary', 'Online booking with your rules', 'Customers book themselves into the slots, services and staff you allow.', ['clinics', 'trades']],
            ['diary', 'Reminders the day before', 'Confirmations and reminders by text or email, with a link to move.', ['clinics', 'trades']],
            ['diary', 'No-show follow-up', 'Missed appointments get a rebooking link without anyone remembering to send it.', ['clinics']],
            ['diary', 'Customers move their own bookings', 'Reschedules happen within your rules and your diary updates itself.', ['clinics', 'trades']],
            ['diary', "The day's jobs, in order", 'Each person gets their jobs in a sensible order, with addresses and notes.', ['trades']],
            ['questions', 'Website chat that knows your business', 'Answers from your own prices, hours and policies, and hands over to a person.', self::ALL],
            ['questions', 'Inbox sorted and answered', 'Routine emails answered, invoices filed, the rest flagged for you.', self::ALL],
            ['questions', '"Where is my order?" answered', 'Order status pulled from your system and sent back straight away.', ['shops']],
            ['questions', 'Returns to your policy', 'Return requests checked against your policy and the next steps sent.', ['shops']],
            ['questions', 'Social messages answered', 'Opening hours, prices and availability answered on your social pages.', ['hospitality', 'shops']],
            ['paperwork', 'Receipts to accounts', 'Photographed or forwarded receipts entered, categorised and matched to the bank.', self::ALL],
            ['paperwork', 'Job sheets from site notes', 'A voice note or photo on site becomes a completed job sheet.', ['trades']],
            ['paperwork', 'Forms before the appointment', 'Intake and consent forms completed and filed before the customer arrives.', ['clinics']],
            ['paperwork', 'New client onboarding', 'Agreement, forms, folders and welcome email set up from one signed quote.', ['agencies']],
            ['paperwork', 'Supplier invoices processed', 'Supplier invoices read, checked against orders and entered in your accounts.', ['hospitality', 'shops']],
            ['paperwork', 'Renewals and certificates tracked', 'Insurance, certificates and registrations reminded before they lapse.', ['trades']],
            ['reporting', 'Monday morning numbers', 'The figures you run the business on, in your inbox every Monday.', self::ALL],
            ['reporting', 'Daily sales to your phone', "Yesterday's takings and top sellers sent first thing.", ['shops', 'hospitality']],
            ['reporting', 'Cash-flow early warning', 'A heads-up when money due in and money going out are heading the wrong way.', self::ALL],
            ['reporting', 'Low stock alerts', 'Items running low flagged before they run out.', ['shops', 'hospitality']],
            ['reviews', 'Review requests after a good job', 'Happy customers asked for a review at the right moment.', ['trades', 'clinics', 'hospitality']],
            ['reviews', 'Review replies drafted for you', 'A reply to every review, drafted in your voice for you to approve.', ['hospitality', 'clinics', 'shops']],
            ['reviews', "Newsletter from your month's work", "Your month's jobs and news turned into a draft newsletter.", ['agencies', 'trades', 'clinics']],
            ['reviews', '"You\'re due" reminders', 'Customers due a service, check-up or refill get a nudge.', ['clinics', 'trades']],
            ['team', 'Rota questions answered', 'Staff ask who is on and when, and get the answer from the rota.', ['hospitality']],
            ['team', 'Timesheets without chasing', 'Hours collected, checked and sent to payroll.', ['agencies', 'trades']],
            ['team', 'New starter pack', 'Contract, forms, logins and first-week plan sent and tracked.', self::ALL],
            ['team', 'Holiday requests checked', 'Requests checked against cover and passed to you to approve.', self::ALL],
        ];

        return array_map(
            fn (array $idea): array => ['area' => $idea[0], 'title' => $idea[1], 'summary' => $idea[2], 'sectors' => $idea[3]],
            $ideas,
        );
    }
}
