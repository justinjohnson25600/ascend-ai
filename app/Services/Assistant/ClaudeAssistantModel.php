<?php

declare(strict_types=1);

namespace App\Services\Assistant;

use Anthropic\Beta\Messages\BetaToolUseBlock;
use Anthropic\Client;

/**
 * Calls Claude through the official Anthropic PHP SDK.
 *
 * - The briefing (rules plus the website's content) is sent as a cached system block, so repeat
 *   conversations only pay full price for the new messages.
 * - Server-side refusal fallbacks are on: if the model declines, the API retries on a fallback
 *   model inside the same call.
 * - Effort defaults to low: short, factual chat answers do not need deep reasoning.
 */
final class ClaudeAssistantModel implements AssistantModel
{
    public const TOOL_NAME = 'pass_to_justin';

    public function __construct(
        private readonly Client $client,
        private readonly string $model,
        private readonly string $effort,
        private readonly string $briefing,
    ) {}

    public function reply(array $messages): ModelReply
    {
        $response = $this->client->beta->messages->create(
            model: $this->model,
            maxTokens: 4096,
            system: [
                ['type' => 'text', 'text' => $this->briefing, 'cacheControl' => ['type' => 'ephemeral']],
            ],
            tools: [self::tool()],
            messages: $messages,
            outputConfig: ['effort' => $this->effort],
            fallbacks: 'default',
            betas: ['server-side-fallback-2026-07-01'],
            requestOptions: ['timeout' => 45, 'maxRetries' => 1],
        );

        $text = [];
        $toolCalls = [];

        foreach ($response->content as $block) {
            if ($block->type === 'text') {
                $text[] = $block->text;
            } elseif ($block instanceof BetaToolUseBlock) {
                $toolCalls[] = ['id' => $block->id, 'name' => $block->name, 'input' => $block->input];
            }
        }

        return new ModelReply(
            stopReason: (string) $response->stopReason,
            text: trim(implode("\n\n", $text)),
            toolCalls: $toolCalls,
            content: $response->content,
        );
    }

    /**
     * The one tool the assistant has: hand a visitor's details to Justin as an enquiry.
     *
     * @return array<string, mixed>
     */
    public static function tool(): array
    {
        return [
            'name' => self::TOOL_NAME,
            'description' => 'Pass a visitor\'s details to Justin, the founder, as an enquiry. Use only after the visitor has asked to talk to a person, book the free audit or get a quote, has given their name and email address, and has agreed to you passing them on. Justin replies within one working day and the visitor gets a confirmation email.',
            'strict' => true,
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'name' => ['type' => 'string', 'description' => 'The visitor\'s name as they gave it.'],
                    'email' => ['type' => 'string', 'description' => 'The visitor\'s email address as they gave it.'],
                    'business' => ['type' => 'string', 'description' => 'Their business name, or an empty string if they did not give one.'],
                    'enquiry_type' => ['type' => 'string', 'enum' => ['audit', 'quote', 'general'], 'description' => 'audit if they want the free automation audit, quote for a specific project, general for anything else.'],
                    'summary' => ['type' => 'string', 'description' => 'One or two sentences on what their business does and what they want, in their words where possible.'],
                ],
                'required' => ['name', 'email', 'business', 'enquiry_type', 'summary'],
                'additionalProperties' => false,
            ],
        ];
    }
}
