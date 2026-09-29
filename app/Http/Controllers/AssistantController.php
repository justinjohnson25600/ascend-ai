<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AssistantMessageRequest;
use App\Services\Assistant\WebsiteAssistant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * The website assistant's endpoints. The conversation lives in the visitor's session only, so it
 * lasts for the visit and is not stored anywhere else.
 */
final class AssistantController extends Controller
{
    private const HISTORY = 'assistant.history';

    private const HAND_OFFS = 'assistant.hand_offs';

    /** Visitor and assistant messages kept per visit before the chat points to the audit instead. */
    private const MAX_HISTORY = 40;

    private const LIMIT_REPLY = "We've covered a lot. The quickest next step is the free 30 minute audit, where Justin can answer everything properly. You can book it from the contact page.";

    public function history(Request $request): JsonResponse
    {
        abort_unless(WebsiteAssistant::enabled(), 404);

        return response()->json(['messages' => $request->session()->get(self::HISTORY, [])]);
    }

    public function message(AssistantMessageRequest $request, WebsiteAssistant $assistant): JsonResponse
    {
        abort_unless(WebsiteAssistant::enabled(), 404);

        $session = $request->session();
        $history = $session->get(self::HISTORY, []);
        $message = trim((string) $request->validated('message'));

        if (count($history) >= self::MAX_HISTORY) {
            return response()->json(['reply' => self::LIMIT_REPLY, 'limit' => true]);
        }

        if (! $this->withinDailyLimit()) {
            return response()->json(['reply' => WebsiteAssistant::UNAVAILABLE]);
        }

        try {
            $result = $assistant->respond($history, $message, (int) $session->get(self::HAND_OFFS, 0));
        } catch (Throwable $exception) {
            Log::error('Website assistant failed to reply.', ['exception' => $exception]);

            return response()->json(['reply' => WebsiteAssistant::UNAVAILABLE]);
        }

        $history[] = ['role' => 'user', 'content' => $message];
        $history[] = ['role' => 'assistant', 'content' => $result['reply']];
        $session->put(self::HISTORY, $history);
        $session->put(self::HAND_OFFS, $result['handOffs']);

        return response()->json(['reply' => $result['reply']]);
    }

    public function reset(Request $request): JsonResponse
    {
        abort_unless(WebsiteAssistant::enabled(), 404);

        $request->session()->forget([self::HISTORY, self::HAND_OFFS]);

        return response()->json(['messages' => []]);
    }

    /**
     * A site-wide cap on AI calls per day, so a burst of traffic or abuse cannot run up the bill.
     */
    private function withinDailyLimit(): bool
    {
        $key = 'assistant:calls:'.now()->format('Y-m-d');
        Cache::add($key, 0, now()->endOfDay());

        return Cache::increment($key) <= (int) config('ascend.assistant.daily_limit');
    }
}
