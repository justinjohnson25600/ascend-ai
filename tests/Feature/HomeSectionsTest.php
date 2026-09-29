<?php

declare(strict_types=1);

test('the home page walks through an example day with the admin handled', function () {
    $this->get('/')->assertOk()
        ->assertSee('A day in your business, with the admin handled')
        ->assertSeeInOrder(['06:58', '08:14', '10:30', '12:05', '15:40', '18:00', '21:15'])
        ->assertSee('And you did none of it.');
});

test('the home page has an admin cost calculator that promises nothing', function () {
    $this->get('/')->assertOk()
        ->assertSee('What does admin cost you?')
        ->assertSee('This is your number, not our promise.')
        ->assertSee('data-calculator', false)
        ->assertSee('Find out how much could be handed off');
});

test('the example day sits after the areas and before the calculator', function () {
    $this->get('/')->assertSeeInOrder([
        'Built around the jobs that eat your week',
        'A day in your business, with the admin handled',
        "We don't make your business fit the software",
        'What does admin cost you?',
    ], false);
});
