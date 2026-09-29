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
