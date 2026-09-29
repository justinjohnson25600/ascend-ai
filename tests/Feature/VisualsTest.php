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
    ['/how-it-works', 'stages'],
    ['/about', 'founder-quote'],
    ['/contact', 'next-steps'],
]);

test('the four step diagram explains automation in plain words', function () {
    $this->get('/what-is-business-automation')->assertSeeInOrder([
        'Something happens', 'AI reads it', 'It does the job', 'You hear about it',
    ]);
});

test('legal pages keep a plain single column hero', function (string $path) {
    $this->get($path)->assertOk()->assertDontSee('data-graphic=', false);
})->with(['/privacy-policy', '/terms-and-conditions']);
