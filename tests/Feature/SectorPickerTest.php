<?php

declare(strict_types=1);

test('solutions shows a typical first stage for each kind of business', function () {
    $this->get('/solutions')->assertOk()
        ->assertSee('What a first stage often looks like for a business like yours')
        ->assertSee('Typical, not fixed.')
        ->assertSeeInOrder(['A trade', 'A clinic or salon', 'An agency or consultancy', 'A café, pub or restaurant', 'A shop or online store'])
        ->assertSee('Missed calls texted back and booked in.')
        ->assertSee('A daily sales summary sent to your phone.')
        ->assertSee('role="tablist"', false);
});

test('the picker sits after the six areas and links to the ideas library', function () {
    $this->get('/solutions')
        ->assertSeeInOrder(['id="reporting"', 'What a first stage often looks like', 'See more ideas in the automation ideas library', "What we don't do"], false)
        ->assertSee('href="'.url('/automation-ideas').'"', false);
});
