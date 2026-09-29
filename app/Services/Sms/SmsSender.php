<?php

declare(strict_types=1);

namespace App\Services\Sms;

interface SmsSender
{
    /**
     * Send a text message. Implementations throw on failure; callers decide whether that matters.
     */
    public function send(string $to, string $body): void;
}
