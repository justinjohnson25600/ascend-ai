<?php

use App\Services\Assistant\WebsiteAssistant;
use App\SystemStatus\StatusReport;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

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

// The online check behind /admin/system-status: latest releases, security problems and support dates.
Artisan::command('system-status:check', function (StatusReport $status) {
    $data = $status->check();
    $report = $status->build();

    $this->info('Checked. Security problems: '.$report['summary']['security'].', major upgrades: '.$report['summary']['major'].', updates: '.$report['summary']['update'].'.');

    foreach ($data['errors'] as $error) {
        $this->warn($error);
    }

    return 0;
})->purpose('Check installed packages against the latest releases and published security problems');

// Needs the server's cron to run "schedule:run" every minute; the page's Check now button works without it.
Schedule::command('system-status:check')->dailyAt('06:00')->withoutOverlapping();
