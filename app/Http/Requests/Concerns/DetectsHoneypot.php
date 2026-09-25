<?php

declare(strict_types=1);

namespace App\Http\Requests\Concerns;

trait DetectsHoneypot
{
    /**
     * The hidden "website" field is never shown to people. Anything in it came from a bot.
     */
    public function isSpam(): bool
    {
        return $this->filled('website');
    }
}
