<?php

use App\Services\Assistant\WebsiteAssistant;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// One real question through the website assistant, to confirm the AI provider key and model work.
Artisan::command('assistant:check {question=What does Ascend AI automate}', function (WebsiteAssistant $assistant) {
    if (! WebsiteAssistant::enabled()) {
        $this->error('The website assistant is off. Set ANTHROPIC_API_KEY (and leave ASSISTANT_ENABLED unset or true), then run config:cache.');

        return 1;
    }

    $this->line('Asking: '.$this->argument('question'));
    $result = $assistant->respond([], (string) $this->argument('question'), WebsiteAssistant::MAX_HAND_OFFS);
    $this->info($result['reply']);

    return 0;
})->purpose('Send one question to the website assistant and print the answer');
