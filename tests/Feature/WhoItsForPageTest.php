<?php

declare(strict_types=1);

test('who it is for opens with a carousel that starts on building firms and trades', function () {
    $this->get('/who-its-for')->assertOk()
        ->assertSee('aria-roledescription="carousel"', false)
        ->assertSeeInOrder(['<h1', 'Small building firms and trades'], false)
        ->assertSeeInOrder([
            'Small building firms and trades',
            'Clinics and salons',
            'Cafés, pubs and restaurants',
            'Agencies and consultancies',
            'Shops and online stores',
        ]);
});

test('who it is for explains the specialism section by section', function () {
    $this->get('/who-its-for')->assertOk()
        ->assertSee('specialises in automation for building firms and trades of 1 to 25 people')
        ->assertSeeInOrder([
            'Why we specialise in building firms and trades',
            'Receipts that file themselves',
            'A second pair of eyes before anything goes to HMRC',
            'Pricing that learns from every job',
            'More of the paperwork, handled',
            'The paperwork calendar',
            'Who we work with',
            'Questions builders ask',
        ]);
});

test('who it is for carries its graphic and an animated example for every business', function () {
    $response = $this->get('/who-its-for')->assertOk()->assertSee('data-graphic="trades"', false);

    foreach (['receipts-in', 'pre-check', 'job-review', 'diary', 'table-booking', 'onboarding', 'order-status'] as $name) {
        $response->assertSee('data-vignette="'.$name.'"', false);
    }
});

test('who it is for says we check and flag, and never file or give tax advice', function () {
    $this->get('/who-its-for')->assertOk()
        ->assertSee('we never file anything or give tax advice')
        ->assertSee('It is not tax or legal advice');
});

test('who it is for cites a source for every figure', function () {
    $this->get('/who-its-for')->assertOk()
        ->assertSee('885,485')
        ->assertSee('href="https://www.gov.uk/government/statistics/business-population-estimates-2025"', false)
        ->assertSee('href="https://www.gov.uk/government/statistics/company-insolvencies-august-2026/commentary-company-insolvency-statistics-august-2026"', false)
        ->assertSee('href="https://www.gov.uk/government/statistics/building-materials-and-components-statistics-august-2026--2"', false)
        ->assertSee('href="https://www.legislation.gov.uk/uksi/2026/289/made"', false);
});

test('who it is for is in the menu, the footer and the sitemap, and home and solutions lead with it', function () {
    $this->get('/')->assertOk()
        ->assertSee('href="'.url('/who-its-for').'"', false)
        ->assertSee("Who It's For")
        ->assertSee('Built for small building firms and trades');

    $this->get('/solutions')->assertSee('We specialise in small building firms and trades');
    $this->get('/sitemap.xml')->assertSee(url('/who-its-for'));
});
