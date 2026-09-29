# CLAUDE.md - Ascend AI

## What this is

The brochure website for Ascend AI (ascend-ai.co.uk). A Laravel 12 monolith with eight public marketing pages, a contact form and a newsletter signup. There is no API and no product logic. Laravel Breeze provides login for a future admin area; public registration is disabled.

**Positioning (since September 2026): Business Automation Solutions.** Bespoke AI automation for UK owner-run small businesses. The copy on every page comes from `docs/CONTENT_BLUEPRINT_V2.md`; change the blueprint first, then the Blade. Do not invent claims, metrics or customers. Phase 2 items (examples page, imagery, analytics with consent, newsletter double opt-in) are listed in `docs/REPOSITIONING-PLAN.md`.

## Stack as it actually is

| Layer | Actual |
|-------|--------|
| Framework | Laravel 12, PHP 8.4. `declare(strict_types=1)` on all new files |
| Database | PostgreSQL in production. SQLite in-memory for tests |
| Views | Blade components, Tailwind CSS 3.4, Alpine.js 3 |
| Build | Vite 7. `public/build` is committed because production deploys by `git pull` |
| Auth | Laravel Breeze (Blade). Register routes removed |
| Tests | Pest 3 function style (`tests/Pest.php`) alongside Breeze's PHPUnit classes |
| Formatter | Laravel Pint, default preset |

## Where things live

- `routes/web.php`: all public pages, 301 redirects from the old venture-studio URLs, the two POST endpoints (throttled 5 per minute per IP), dashboard and profile.
- `app/Enums/EnquiryType.php`: the contact form's enquiry types and their labels. The form select, validation, the Mailable subject and the email template all read from it. Add a case here, nowhere else.
- `app/Http/Controllers/PageController.php`: every page plus the contact and newsletter handlers. Deliberately one thin controller. There is no service layer; add one only when a second consumer of the logic appears.
- `app/Http/Requests/`: a Form Request for every POST. `Concerns/DetectsHoneypot` provides `isSpam()`.
- `app/Models/Contact.php` and `NewsletterSubscription.php`: the only custom tables.
- `app/Actions/RecordEnquiry.php`: what happens when anyone gets in touch (contact form or website assistant): store the `Contact`, email `config('ascend.contact_to')` (`ContactFormMail`), send the visitor an instant reply (`EnquiryReceivedMail`, at most once a day per address, never echoing their text), and text the owner about audit and quote requests. Every send is synchronous and wrapped, so a failure is logged and the visitor still sees success.
- `app/Services/Assistant/`: the website chat. `WebsiteAssistant` runs a visitor turn (model reply, the `pass_to_justin` hand-off through `RecordEnquiry`, at most two per chat); `ClaudeAssistantModel` calls Claude via the official `anthropic-ai/sdk` (cached briefing, strict tool, server-side refusal fallbacks, low effort); `AssistantModel` is the seam tests replace. `AssistantController` keeps the conversation in the session only, caps it at 40 messages, and enforces `ASSISTANT_DAILY_LIMIT`. The briefing, rules plus site content, is `resources/assistant/system-prompt.md`: update it whenever the site copy changes. `php artisan assistant:check` sends one real question.
- `app/Services/Sms/`: `SmsSender` with `TwilioSmsSender` (plain HTTP, no SDK) and `LogSmsSender` (the default). Bound in `AppServiceProvider` from `SMS_DRIVER`.
- `app/Support/`: `Booking::url()` (https-only booking link or null) and `AutomationIdeas` (the ideas library data).
- `resources/views/components/vignettes/`: the animated "automation in action" stories, driven by the `vignette` Alpine component in `app.js`. `components/graphics/`: static hero graphics.
- `config/ascend.php`: project settings (contact mailbox, company name and registered address, social profile URLs, seeded admin). Put new project config here. The footer, legal pages and JSON-LD all read from it.
- `resources/views/components/`: `layout/` (app, header, footer), `sections/` (hero, cta), `ui/` (card, section-heading, social-links), `buttons/`, `forms/honeypot`.
- `resources/views/errors/404.blade.php`: the branded not-found page.
- `resources/views/pages/`: one Blade file per public page, wrapped in `<x-layout.app :title :description>`.
- `resources/js/app.js`: Alpine bootstrap and the `newsletterForm` component. Page-specific Alpine lives in `@push('scripts')` inside that page.
- `docs/`: the January 2026 content blueprint, technical spec and agent notes. They describe the old venture-studio positioning and are reference only.

## Conventions in use

- A page is a route, a `PageController` method and `resources/views/pages/<slug>.blade.php`. The meta description is passed from the controller.
- Forms post JSON with `fetch`, send `Accept: application/json`, and expect `{ success, message }`. Validation failures come back as 422 with Laravel's `message`.
- Every public form includes `<x-forms.honeypot model="..." />` and its Alpine state has a `website: ''` field.
- Dark theme only. Colours are the `navy` and `accent` scales in `tailwind.config.js`. No inline styles except background images.
- British English in copy and comments (organisation, enquiry).
- Tables are snake_case plural, models singular PascalCase, casts via the `casts()` method.
- Every audit call to action links to `route('contact', ['type' => 'audit'])`, which preselects the enquiry type.
- Blade gotcha: never mix the one-line `@php(...)` form with a `@php ... @endphp` block in the same file. Blade pairs the first `@php` with the first `@endphp` and swallows everything between them. Use the block form for both.

## Commands

```bash
composer dev            # serve, queue, logs and vite together
php artisan test        # must be green before committing
vendor/bin/pint         # format
npm run build           # regenerate public/build; commit it with any view or CSS change
```

## Environment

`CONTACT_EMAIL_TO` sets the enquiry mailbox. `ADMIN_EMAIL` and `ADMIN_PASSWORD` let `php artisan db:seed` create the first user; the seeder skips when they are missing and has no default credentials on purpose. See `.env.example`.

## Do not

- Re-add public registration, or any "temporary" script under `public/`.
- Add packages for features that are not being built. Filament, Horizon, Pulse, Reverb, Inertia, Ziggy and Sanctum were removed for this reason. `anthropic-ai/sdk` is the one deliberate addition, for the website assistant.
- Show raw server error text to visitors. Front-end scripts display our own messages and 422 validation messages only.
- Queue the contact mail unless a queue worker is confirmed running in production.
- Add analytics or marketing cookies without a consent banner (UK PECR).
- Write copy with metric claims (margins, timelines, customer counts) that the founder has not approved.
- Change authentication or the legal pages without asking.
- Refactor code you were not asked to touch.
