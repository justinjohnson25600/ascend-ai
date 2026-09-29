<?php

declare(strict_types=1);

test('how it works shows what the free audit document looks like', function () {
    $this->get('/how-it-works')->assertOk()
        ->assertSeeInOrder(['The process', 'What you get from the free audit', 'data-graphic="audit-preview"', 'How we charge'], false)
        ->assertSee('You get it within two working days of the call.')
        ->assertSee('Example layout');
});

test('the audit drawing shows headings but no real figures', function () {
    $html = $this->get('/how-it-works')->getContent();

    foreach (['How your business runs today', 'Where the hours go', 'What we would automate first', 'What each would involve', 'Rough cost range'] as $heading) {
        expect($html)->toContain($heading);
    }
});

test('contact shows a smaller audit drawing with its caption', function () {
    $this->get('/contact')->assertOk()
        ->assertSee('data-graphic="audit-preview"', false)
        ->assertSee('What your written audit looks like.');
});
