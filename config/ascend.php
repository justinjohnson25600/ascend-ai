<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Contact Enquiries
    |--------------------------------------------------------------------------
    |
    | The mailbox that receives contact form submissions.
    |
    */

    'contact_to' => env('CONTACT_EMAIL_TO', 'contact@ascend-ai.co.uk'),

    /*
    |--------------------------------------------------------------------------
    | Seeded Admin User
    |--------------------------------------------------------------------------
    |
    | Used by DatabaseSeeder to create the first user. The seeder skips this
    | step when either value is missing, so no default credentials exist.
    |
    */

    'admin' => [
        'name' => env('ADMIN_NAME', 'Admin'),
        'email' => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD'),
    ],

];
