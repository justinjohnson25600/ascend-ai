<?php

declare(strict_types=1);

use App\Support\AutomationIdeas;

test('the ideas library lists every idea with its job and the businesses it suits', function () {
    $ideas = AutomationIdeas::all();

    $response = $this->get('/automation-ideas')->assertOk()
        ->assertSee('Automation ideas for small businesses')
        ->assertSee(count($ideas).' jobs small businesses hand to automation');

    expect(substr_count($response->getContent(), 'data-idea'))->toBe(count($ideas));

    foreach ($ideas as $idea) {
        $response->assertSee($idea['title']);
    }
});

test('every idea belongs to a known job and at least one known kind of business', function () {
    foreach (AutomationIdeas::all() as $idea) {
        expect(AutomationIdeas::AREAS)->toHaveKey($idea['area'])
            ->and($idea['sectors'])->not->toBeEmpty();

        foreach ($idea['sectors'] as $sector) {
            expect(AutomationIdeas::SECTORS)->toHaveKey($sector);
        }
    }
});

test('the library has thirty eight ideas covering every job', function () {
    $ideas = collect(AutomationIdeas::all());

    expect($ideas)->toHaveCount(38)
        ->and($ideas->pluck('area')->unique()->sort()->values()->all())
        ->toEqual(collect(array_keys(AutomationIdeas::AREAS))->sort()->values()->all());
});

test('visitors can filter by kind of business and by job', function () {
    $response = $this->get('/automation-ideas');

    foreach (AutomationIdeas::SECTORS + AutomationIdeas::AREAS as $label) {
        $response->assertSee($label);
    }

    $response->assertSee('Nothing matches both filters.');
});

test('the ideas library is in the sitemap and the footer', function () {
    $this->get('/sitemap.xml')->assertSee(url('/automation-ideas'));
    $this->get('/about')->assertSee('href="'.url('/automation-ideas').'"', false);
});
