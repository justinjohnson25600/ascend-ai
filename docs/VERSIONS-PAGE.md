# Prompt: add the system status page to this site

Give this whole file to Claude Code in the other site's repository, with: "Add the system status page described in this file to this site."

---

## What to build

An admin-only page at `/admin/system-status` that shows:

- **Versions.** PHP and Laravel, with their support dates, and every direct Composer and npm package: installed, allowed range, the newest release in the installed line (the safe update), the newest release overall, and status (security problem, major upgrade, update, up to date).
- **Security problems.** Published advisories that affect the installed versions.
- **Live code.** Which commit is checked out on the server.
- **Server vs repository.** Whether the server matches the repository: packages against `composer.lock`, pending migrations, build files present, and no development packages on production.

It has two buttons:

- **Check now:** runs the online lookups.
- **Copy for Claude Code:** copies the whole report as plain text. The owner pastes that into Claude Code and asks for update prompts.

The page reports; it never updates anything itself.

## The reference implementation: copy it

The working version is in the Ascend AI repository on this PC, `C:\Dev\Ascend-AI` (Laravel 12, plain Blade, no Filament). Read these files and copy them, changing only what this site needs:

| File | What it is |
| --- | --- |
| `app/SystemStatus/Versions.php` | Version maths: normalise, group into release lines, classify an update (a newer release in the installed line is an "update" even when a newer major exists), match Packagist affected-version ranges (dev branches count as affected). No framework code. Copy unchanged. |
| `app/SystemStatus/Inventory.php` | What is installed, from local files only: `composer.json`, `composer.lock`, `Composer\InstalledVersions`, `package.json`, `package-lock.json`, `.git`, migrations, `public/build/manifest.json` |
| `app/SystemStatus/Registry.php` | Online lookups: Packagist (`repo.packagist.org/p2/{name}.json`, `packagist.org/api/security-advisories/`), npm (abbreviated metadata from `registry.npmjs.org/{name}` with `Accept: application/vnd.npm.install-v1+json`, and `/-/npm/v1/security/advisories/bulk`), endoflife.date (`/api/php.json`, `/api/laravel.json`, every release line cached). Advisory links are only kept when they start with http or https |
| `app/SystemStatus/StatusReport.php` | Combines the two, caches the online part forever under `system-status`, and writes the copied text |
| `app/SystemStatus/SystemStatusController.php` | `show` (no-store header) and `check` |
| `config/system-status.php` | Admin emails (`SYSTEM_STATUS_ADMINS`; missing or blank falls back to `ADMIN_EMAIL`), timeout, timezone |
| `resources/views/system-status/index.blade.php` | The page. See "Fitting the view to this site" below |
| Gate in `app/Providers/AppServiceProvider.php` | `Gate::define('view-system-status', ...)`: the user's email is verified (`hasVerifiedEmail()`) and in `(array) config('system-status.admins', [])`. Checking verification in the gate matters: users can change their own email, and the `verified` route middleware does nothing unless `User` implements `MustVerifyEmail` |
| Routes in `routes/web.php` | `auth` + `verified` + `can:view-system-status`; the POST check route adds `throttle:6,1` |
| `routes/console.php` | `system-status:check` command, plus `Schedule::command(...)->dailyAt('06:00')` |
| `tests/Unit/SystemStatusVersionsTest.php`, `tests/Feature/SystemStatusTest.php`, `tests/Feature/SystemStatusInventoryTest.php` | Copy and adapt. They take versions and constraints from the project's own files, so they survive upgrades. Adapt the layout text, the `robots` meta assertion, and the user factory (it needs an `unverified()` state) |

If this site's code style differs (for example no `declare(strict_types=1)`, or PHPUnit classes instead of Pest), follow this site's conventions and its CLAUDE.md.

## Rules to keep (they are why it works on Plesk)

1. **No shell commands.** Do not call `composer`, `npm` or `git`. On Plesk a web request usually cannot run them, and Node is not installed on the live server. Everything installed is read from files; everything latest is fetched over HTTPS.
2. **Never a false all clear.** Every lookup fails on its own and is recorded in `errors`. A failed lookup keeps the previous good result. The page says "not checked yet", "some lookups failed" or "packages changed since the last check" when true.
3. **Keep security results right after a deploy.** Composer advisories are matched against the versions installed when the page is shown. npm filters by version when asked, so an npm advisory is kept only while that package still has a version that was checked; once the fix is in `package-lock.json` it drops away, and the page asks for a new check.
4. **Admin only.** Logged in, and the email is on the list; an empty list means nobody. The page is `noindex` and `Cache-Control: no-store, private`. The Check button is POST with CSRF and throttled.
5. **Development packages** show "Not on this server" on a `--no-dev` production install. That is correct, not an error.
6. **npm versions come from `package-lock.json`** (lockfileVersion 2 or 3): what the committed build was made with. If `package.json` lists packages but no locked versions can be read, the check records an error and security shows as not checked. It is never reported as clear.
7. **"Not checked" is never "none".** If the security lookups have never succeeded, the page shows "?" and the copied text says "not checked".

## Fitting the view to this site

The Ascend view is not drop-in. Before copying it:

- **Layout.** Change `<x-layout.app :noIndex="true" ...>` to this site's admin layout, and keep a `noindex, nofollow` robots meta.
- **Styling.** Restyle it with this site's own classes and theme, light or dark. It uses Ascend's `card-glass`, `container-default`, `btn` and the `navy` and `accent` colours.
- **Alpine.** The copy button needs Alpine. Keep elements hidden until Alpine starts with an `[x-cloak]` rule. Ascend scopes it as `.js [x-cloak] { display: none !important; }`, with `<script>document.documentElement.classList.add('js');</script>` in the layout head, so content stays readable without JavaScript.
- **Build.** New Tailwind classes need `npm run build`; commit `public/build` if the site deploys a committed build.
- **Link.** Add a link from the site's dashboard or admin menu for users who pass the gate.

## If the site uses Filament

Build the same page as a Filament page instead of the Blade route and view. Reuse `Inventory`, `Registry`, `StatusReport`, `Versions` and the gate unchanged.

- **The page:** `app/Filament/Pages/SystemStatus.php`, with `canAccess()` returning `Gate::allows('view-system-status')`. That hides the navigation item from others as well. Put it in the admin navigation group.
- **Header actions:**
  - **Check now:** calls `app(StatusReport::class)->check()`, then shows a Filament notification. Rate-limit it the way the Blade route's `throttle:6,1` does: `RateLimiter::attempt('system-status:'.auth()->id(), 6, fn () => ..., 60)`, with a warning notification when it is limited.
  - **Copy for Claude Code:** an Alpine `x-on:click` that copies a hidden `<textarea>` holding `StatusReport::text()`.
- **The view:** render the same sections with Filament's section and table styling, or plain Tailwind.
- **Filament 4/5 declarations:**
  - `protected string $view` (not static);
  - `protected static string|\BackedEnum|null $navigationIcon`;
  - `protected static string|\UnitEnum|null $navigationGroup`.
- **Filament 3 declarations:**
  - `protected static string $view`;
  - `protected static ?string $navigationIcon`;
  - `protected static ?string $navigationGroup`.
- **Do not nest Livewire components inside the page.** In production they caused HTTP 419 errors (see `C:\Dev\KILNCITY\FILAMENT-ADMIN-OPS-KIT.md`, principle 6).

If the site already has the **Admin Ops Kit "Updates" page** (`app/Support/DependencyReport.php`, `deps:check`), ask the owner whether to replace it with this page or keep both. Do not delete it without asking.

## Server setup (Plesk)

1. In the site's `.env`, set `SYSTEM_STATUS_ADMINS=owner@example.com`, or leave it out or blank to use `ADMIN_EMAIL`. Then run `/opt/plesk/php/8.4/bin/php artisan optimize` in the site folder, because production caches config. The admin's account must have a verified email. If they get 403, mark it verified: `php artisan tinker --execute="App\Models\User::where('email', 'owner@example.com')->update(['email_verified_at' => now()])"`.
2. **Optional:** a Plesk scheduled task running `/opt/plesk/php/8.4/bin/php {site path}/artisan schedule:run` every minute, so the check runs daily at 06:00. Without it, the Check now button still works.
3. **Deploy as usual:** `git pull`, `composer install --no-dev --optimize-autoloader`, `php artisan migrate --force`, `php artisan optimize`.

## Done when

- [ ] A guest is sent to log in. A logged-in user not on the list, or on it with an unverified email, gets 403 on both the page and the check.
- [ ] A package with a newer release in its own line shows that release as the update, with the newest overall beside it.
- [ ] Before any check, the page lists what is installed and says it has not been checked.
- [ ] Check now fills in the latest versions and security problems, in a few seconds.
- [ ] With the network blocked (or Packagist faked as down in a test), the page says which lookups failed and keeps the earlier results. With the security lookups down, security shows as not checked, never as none.
- [ ] Copy for Claude Code copies text that ends "Please give me the update prompts for this site, grouped and in order."
- [ ] The tests pass, and so does the site's full test suite.
