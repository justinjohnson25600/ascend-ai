# CLAUDE.md - Ascend AI

## What this is

The brochure website for Ascend AI (ascend-ai.co.uk). A Laravel 12 monolith with eight public marketing pages, a contact form and a newsletter signup. There is no API and no product logic. Laravel Breeze provides login for a future admin area; public registration is disabled.

**Repositioning in progress (September 2026).** The site copy still describes an "AI venture studio". The company is repositioning as **Business Automation Solutions: AI automation platforms for small businesses**. Read `docs/REPOSITIONING-PLAN.md` before changing any copy. Do not invent claims, metrics or customers.

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

- `routes/web.php`: all public pages, the two POST endpoints (throttled 5 per minute per IP), dashboard and profile.
- `app/Http/Controllers/PageController.php`: every page plus the contact and newsletter handlers. Deliberately one thin controller. There is no service layer; add one only when a second consumer of the logic appears.
- `app/Http/Requests/`: a Form Request for every POST. `Concerns/DetectsHoneypot` provides `isSpam()`.
- `app/Models/Contact.php` and `NewsletterSubscription.php`: the only custom tables.
- `app/Mail/ContactFormMail.php`: sent synchronously to `config('ascend.contact_to')`. A send failure is logged and the visitor still sees success, because the row is already stored.
- `config/ascend.php`: project settings (contact mailbox, seeded admin). Put new project config here.
- `resources/views/components/`: `layout/` (app, header, footer), `sections/` (hero, cta), `ui/` (card, section-heading), `buttons/`, `forms/honeypot`.
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
- Add packages for features that are not being built. Filament, Horizon, Pulse, Reverb, Inertia, Ziggy and Sanctum were removed for this reason.
- Queue the contact mail unless a queue worker is confirmed running in production.
- Add analytics or marketing cookies without a consent banner (UK PECR).
- Write copy with metric claims (margins, timelines, customer counts) that the founder has not approved.
- Change authentication or the legal pages without asking.
- Refactor code you were not asked to touch.
