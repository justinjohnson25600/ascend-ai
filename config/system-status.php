<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | System Status Page
    |--------------------------------------------------------------------------
    |
    | /admin/system-status shows what is installed (PHP, Laravel, every Composer
    | and npm package), the latest release of each, and published security
    | problems, with a button that copies it all as text for Claude Code.
    |
    | Only logged-in users with a verified email that is listed in "admins" can
    | open it. List several with commas in SYSTEM_STATUS_ADMINS; when that is
    | missing or blank it falls back to ADMIN_EMAIL. When both are empty, nobody
    | can open the page.
    |
    */

    'admins' => array_values(array_filter(array_map(
        fn (string $email): string => strtolower(trim($email)),
        explode(',', (string) (env('SYSTEM_STATUS_ADMINS') ?: env('ADMIN_EMAIL', ''))),
    ))),

    // Seconds allowed for each online lookup (Packagist, npm, endoflife.date).
    'timeout' => (int) env('SYSTEM_STATUS_TIMEOUT', 10),

    // Times on the page and in the copied report.
    'timezone' => 'Europe/London',

];
