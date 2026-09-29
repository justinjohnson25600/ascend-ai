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
    | Online Booking
    |--------------------------------------------------------------------------
    |
    | The public booking page for free automation audits (Cal.com, Calendly or
    | similar). When set, the contact page offers it and the instant reply to
    | every enquiry links to it. Leave empty to hide both.
    |
    */

    'booking_url' => env('BOOKING_URL'),

    /*
    |--------------------------------------------------------------------------
    | Company Details
    |--------------------------------------------------------------------------
    |
    | Used by the footer, the legal pages and the structured data in the layout.
    |
    */

    'company' => [
        'name' => 'Ascend AI',
        'descriptor' => 'Business Automation Solutions',
        'email' => 'contact@ascend-ai.co.uk',
        'address' => [
            'Matrix House',
            '12-16 Lionel Road',
            'Canvey Island',
            'Essex',
            'SS8 9DE',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Profiles
    |--------------------------------------------------------------------------
    */

    'social' => [
        'linkedin' => 'https://linkedin.com/company/ascend-ai',
        'youtube' => 'https://youtube.com/@ascend-ai',
        'instagram' => 'https://instagram.com/ascend.ai',
        'x' => 'https://x.com/ascend_ai',
        'facebook' => 'https://facebook.com/ascend.ai',
    ],

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
