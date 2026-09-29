<?php

declare(strict_types=1);

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;

/**
 * Sends texts through Twilio's REST API. No SDK needed for a single endpoint.
 */
final class TwilioSmsSender implements SmsSender
{
    public function __construct(
        private readonly string $accountSid,
        private readonly string $authToken,
        private readonly string $from,
    ) {}

    public function send(string $to, string $body): void
    {
        Http::asForm()
            ->withBasicAuth($this->accountSid, $this->authToken)
            ->timeout(10)
            ->post("https://api.twilio.com/2010-04-01/Accounts/{$this->accountSid}/Messages.json", [
                'To' => $to,
                'From' => $this->from,
                'Body' => $body,
            ])
            ->throw();
    }
}
