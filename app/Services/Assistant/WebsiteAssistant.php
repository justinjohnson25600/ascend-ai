<?php

declare(strict_types=1);

namespace App\Services\Assistant;

use App\Actions\RecordEnquiry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Runs one visitor turn of the website assistant: asks the model, carries out a hand-off to
 * Justin when the model asks for one, and returns the text to show.
 */
final class WebsiteAssistant
{
    public const UNAVAILABLE = "Sorry, I can't answer right now. You can use the contact form or email contact@ascend-ai.co.uk.";

    public const DECLINED = "Sorry, I can't help with that one. If it's about your business, Justin can answer through the contact form.";

    public const MAX_HAND_OFFS = 2;

    private const MAX_TOOL_ROUNDS = 3;

    public function __construct(
        private readonly AssistantModel $model,
        private readonly RecordEnquiry $recordEnquiry,
    ) {}

    public static function enabled(): bool
    {
        $key = config('services.anthropic.key');

        return (bool) config('ascend.assistant.enabled') && is_string($key) && $key !== '';
    }

    /**
     * @param  list<array{role: string, content: string}>  $history  earlier turns, text only
     * @return array{reply: string, handOffs: int}
     */
    public function respond(array $history, string $message, int $handOffsSoFar): array
    {
        $messages = [...$history, ['role' => 'user', 'content' => $message]];
        $handOffs = $handOffsSoFar;
        $reply = null;

        for ($round = 0; $round < self::MAX_TOOL_ROUNDS; $round++) {
            $reply = $this->model->reply($messages);

            if ($reply->stopReason === 'refusal') {
                return ['reply' => self::DECLINED, 'handOffs' => $handOffs];
            }

            if ($reply->stopReason !== 'tool_use' || $reply->toolCalls === []) {
                break;
            }

            $results = [];

            foreach ($reply->toolCalls as $call) {
                [$ok, $outcome] = $call['name'] === ClaudeAssistantModel::TOOL_NAME
                    ? $this->handOff($call['input'], $handOffs)
                    : [false, 'Unknown tool.'];

                $handOffs += $ok ? 1 : 0;
                $results[] = ['type' => 'tool_result', 'toolUseID' => $call['id'], 'content' => $outcome, 'isError' => ! $ok];
            }

            $messages[] = ['role' => 'assistant', 'content' => $reply->content];
            $messages[] = ['role' => 'user', 'content' => $results];
        }

        $text = $reply?->text ?? '';

        return ['reply' => $text !== '' ? $text : self::UNAVAILABLE, 'handOffs' => $handOffs];
    }

    /**
     * @param  array<string, mixed>  $input
     * @return array{0: bool, 1: string}
     */
    private function handOff(array $input, int $handOffsSoFar): array
    {
        if ($handOffsSoFar >= self::MAX_HAND_OFFS) {
            return [false, 'Details have already been passed to Justin from this chat. Do not pass them again; tell the visitor he will be in touch.'];
        }

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'business' => ['nullable', 'string', 'max:255'],
            'enquiry_type' => ['required', 'in:audit,quote,general'],
            'summary' => ['required', 'string', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return [false, 'Not passed on: '.implode(' ', $validator->errors()->all()).' Ask the visitor to check and try again.'];
        }

        $this->recordEnquiry->handle([
            'name' => (string) $input['name'],
            'email' => (string) $input['email'],
            'organisation' => Str::of((string) $input['business'])->trim()->toString() ?: null,
            'enquiry_type' => (string) $input['enquiry_type'],
            'message' => 'Via the website assistant: '.Str::squish((string) $input['summary']),
        ]);

        return [true, 'Passed to Justin. He will reply within one working day, and a confirmation email is on its way to the visitor.'];
    }
}
