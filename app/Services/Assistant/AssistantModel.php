<?php

declare(strict_types=1);

namespace App\Services\Assistant;

/**
 * The language model behind the website assistant. The real implementation calls Claude;
 * tests bind a scripted stand-in.
 */
interface AssistantModel
{
    /**
     * @param  list<array<string, mixed>>  $messages  conversation so far, oldest first, ending with the visitor
     */
    public function reply(array $messages): ModelReply;
}
