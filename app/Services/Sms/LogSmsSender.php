<?php

declare(strict_types=1);

namespace App\Services\Sms;

use Illuminate\Support\Facades\Log;

/**
 * Writes texts to the log instead of sending them. The default until a text provider is set up.
 */
final class LogSmsSender implements SmsSender
{
    public function send(string $to, string $body): void
    {
        Log::info('Text alert (SMS_DRIVER=log, not sent).', ['to' => $to, 'body' => $body]);
    }
}
