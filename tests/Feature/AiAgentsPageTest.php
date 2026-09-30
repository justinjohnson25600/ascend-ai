<?php

declare(strict_types=1);

test('the ai agents page explains agents and how they get better, in order', function () {
    $this->get('/ai-agents')->assertOk()
        ->assertSee('AI agents that get better at your business')
        ->assertSeeInOrder([
            'What is an AI agent?',
            'How it gets better',
            'Suggestions, with its reasons',
            'You decide how much it does on its own',
            'Built to be checked',
            'What an agent does, and what it learns',
            'Questions owners ask',
        ]);
});

test('the ai agents page carries its graphics and animated examples', function () {
    $this->get('/ai-agents')->assertOk()
        ->assertSee('data-graphic="learning-loop"', false)
        ->assertSee('data-graphic="trust-ladder"', false)
        ->assertSee('data-vignette="lesson"', false)
        ->assertSee('data-vignette="suggestions"', false)
        ->assertSee('aria-label="Example: the owner adds a line', false);
});

test('the ai agents page says learning never means training a model on client data', function () {
    $this->get('/ai-agents')->assertOk()
        ->assertSee('not by retraining an AI model on your data')
        ->assertSee('we never train our own models on it')
        ->assertSee('href="'.url('/your-data').'"', false);
});

test('the ai agents page sends every call to action to the audit', function () {
    $this->get('/ai-agents')->assertOk()
        ->assertSee('href="'.route('contact', ['type' => 'audit']).'"', false)
        ->assertSee('href="'.route('solutions').'#enquiries"', false);
});

test('the ai agents page is in the menu, the footer and the sitemap', function () {
    $this->get('/')->assertSee('href="'.url('/ai-agents').'"', false)->assertSee('AI Agents');
    $this->get('/sitemap.xml')->assertSee(url('/ai-agents'));
});
