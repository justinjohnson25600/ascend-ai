<?php

declare(strict_types=1);

test('every home carousel slide carries its animated example', function () {
    $response = $this->get('/')->assertOk();

    foreach (['missed-call', 'email', 'quote', 'diary', 'chat', 'receipt', 'report'] as $name) {
        $response->assertSee('data-vignette="'.$name.'"', false);
    }
});

test('each what if card on the explainer page has its animated example', function () {
    $response = $this->get('/what-is-business-automation')->assertOk();

    foreach (['email', 'chat', 'receipt', 'missed-call', 'quote', 'diary'] as $name) {
        $response->assertSee('data-vignette="'.$name.'"', false);
    }
});

test('animated examples are labelled as examples and described for screen readers', function () {
    $this->get('/what-is-business-automation')
        ->assertSee('role="img"', false)
        ->assertSee('aria-label="Example: a missed call', false)
        ->assertSee('>Example<', false);
});

test('each solutions area sits beside its animated example', function () {
    $response = $this->get('/solutions')->assertOk();

    foreach (['email', 'quote', 'diary', 'chat', 'receipt', 'report'] as $name) {
        $response->assertSee('data-vignette="'.$name.'"', false);
    }

    $response->assertSeeInOrder(['id="enquiries"', 'data-vignette="email"', 'id="quotes"', 'data-vignette="quote"', 'id="reporting"', 'data-vignette="report"'], false);
});

test('inner page heroes carry their graphic', function (string $path, string $graphic) {
    $this->get($path)->assertOk()->assertSee('data-graphic="'.$graphic.'"', false);
})->with([
    ['/what-is-business-automation', 'flow'],
    ['/solutions', 'hub'],
    ['/ai-agents', 'learning-loop'],
    ['/who-its-for', 'trades'],
    ['/how-it-works', 'stages'],
    ['/about', 'founder-quote'],
    ['/contact', 'next-steps'],
]);

test('the four step diagram explains automation in plain words', function () {
    $this->get('/what-is-business-automation')->assertSeeInOrder([
        'Something happens', 'AI reads it', 'It does the job', 'You hear about it',
    ]);
});

test('section photos are served from files that exist', function (string $path, string $image) {
    $this->get($path)->assertOk()->assertSee('images/'.$image, false);

    expect(public_path('images/'.$image))->toBeFile();
})->with([
    ['/', 'desktop-version.webp'],
    ['/', 'mobile-version.webp'],
    ['/ai-agents', 'agents-desktop.webp'],
    ['/contact', 'contact-desktop.webp'],
]);

test('the contact page no longer uses the city background', function () {
    $this->get('/contact')->assertOk()->assertDontSee('digi-city', false);
});

test('shared links preview the share card', function () {
    $this->get('/')->assertOk()
        ->assertSee('<meta property="og:image" content="'.asset('images/share-card.jpg').'">', false)
        ->assertSee('<meta property="og:image:width" content="1200">', false)
        ->assertSee('<meta name="twitter:image" content="'.asset('images/share-card.jpg').'">', false);

    expect(public_path('images/share-card.jpg'))->toBeFile();
});

test('every public page reveals its content on scroll, the same way', function (string $path) {
    $response = $this->get($path)->assertOk()
        ->assertSee("document.documentElement.classList.add('js')", false);

    expect(preg_match('/class="[^"]*\breveal-(up|stagger)\b/', $response->getContent()))->toBe(1);
})->with([
    '/', '/what-is-business-automation', '/who-its-for', '/solutions', '/ai-agents', '/how-it-works',
    '/about', '/automation-ideas', '/your-data', '/contact', '/privacy-policy', '/terms-and-conditions',
]);

test('section headings and closing calls to action reveal themselves', function () {
    $this->blade('<x-ui.section-heading title="Hello" />')->assertSee('reveal-up', false);
    $this->blade('<x-sections.cta title="Go" />')->assertSee('reveal-up', false);
});

test('legal pages keep a plain single column hero', function (string $path) {
    $this->get($path)->assertOk()->assertDontSee('data-graphic=', false);
})->with(['/privacy-policy', '/terms-and-conditions']);
