<?php

declare(strict_types=1);

namespace App\Services\Assistant;

final class ModelReply
{
    /**
     * @param  string  $stopReason  end_turn, tool_use, max_tokens, refusal...
     * @param  string  $text  the reply's text blocks joined together
     * @param  list<array{id: string, name: string, input: array<string, mixed>}>  $toolCalls
     * @param  mixed  $content  the reply exactly as returned, to send back as the assistant turn when answering a tool call
     */
    public function __construct(
        public readonly string $stopReason,
        public readonly string $text,
        public readonly array $toolCalls,
        public readonly mixed $content,
    ) {}
}
