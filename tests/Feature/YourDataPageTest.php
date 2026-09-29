<?php

declare(strict_types=1);

test('the your data page explains access, where data goes and leaving, in plain words', function () {
    $this->get('/your-data')->assertOk()
        ->assertSee('Your data, in plain English')
        ->assertSee('data-graphic="data-flow"', false)
        ->assertSeeInOrder(['The short version', 'What we might access, and why', 'Where it goes', 'What we never do', 'If something goes wrong', 'When you leave'])
        ->assertSee('The AI providers we use are not allowed to train their models on your data.')
        ->assertSee('Train our own AI models on your data.');
});

test('the your data page is linked from the data question, the footer and the sitemap', function () {
    $this->get('/how-it-works')->assertSee('href="'.url('/your-data').'"', false);
    $this->get('/about')->assertSee('href="'.url('/your-data').'"', false);
    $this->get('/sitemap.xml')->assertSee(url('/your-data'));
});
