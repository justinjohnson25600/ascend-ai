# Ascend AI

Marketing website for Ascend AI, live at [ascend-ai.co.uk](https://ascend-ai.co.uk).

Laravel 12, PHP 8.4, PostgreSQL, Blade, Tailwind CSS 3, Alpine.js, Vite.

## Local setup

```bash
composer install
cp .env.example .env        # then fill in DB_*, MAIL_*, CONTACT_EMAIL_TO, ADMIN_EMAIL, ADMIN_PASSWORD
php artisan key:generate
php artisan migrate --seed
npm install
composer dev
```

## Checks

```bash
php artisan test
vendor/bin/pint --test
```

## Deploying

Production pulls this repository, so compiled assets are committed. After any change to views, CSS or JS run `npm run build` and commit `public/build`. Then on the server:

```bash
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
```

See `CLAUDE.md` for the code conventions and `docs/` for the planning documents.
