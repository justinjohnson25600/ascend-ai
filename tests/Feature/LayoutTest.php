<?php

declare(strict_types=1);

test('heroes that were given no button do not show a default one', function (string $path) {
    $this->get($path)->assertOk()->assertDontSee('Get Started');
})->with(['/what-is-business-automation', '/about', '/contact', '/privacy-policy', '/terms-and-conditions']);

test('the card component keeps the classes passed to it', function () {
    $this->blade('<x-ui.card class="lg:col-span-2 h-full">Body</x-ui.card>')
        ->assertSee('lg:col-span-2', false)
        ->assertSee('h-full', false)
        ->assertSee('card p-6', false);
});

test('the button components keep the classes passed to them', function (string $component) {
    $this->blade("<x-buttons.{$component} text=\"Go\" href=\"/x\" class=\"w-full\" />")
        ->assertSee('w-full', false);
})->with(['primary', 'secondary']);
