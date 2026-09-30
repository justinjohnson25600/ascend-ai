<?php

namespace App\Providers;

use Anthropic\Client;
use App\Models\User;
use App\Services\Assistant\AssistantModel;
use App\Services\Assistant\ClaudeAssistantModel;
use App\Services\Sms\LogSmsSender;
use App\Services\Sms\SmsSender;
use App\Services\Sms\TwilioSmsSender;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Text alerts go through Twilio only when explicitly chosen and fully configured.
        $this->app->bind(SmsSender::class, function (): SmsSender {
            $twilio = config('services.twilio');

            if (config('ascend.sms.driver') === 'twilio' && ! empty($twilio['sid']) && ! empty($twilio['token']) && ! empty($twilio['from'])) {
                return new TwilioSmsSender($twilio['sid'], $twilio['token'], $twilio['from']);
            }

            return new LogSmsSender;
        });

        // The website assistant's model. Only resolved when a visitor sends a message.
        $this->app->bind(AssistantModel::class, fn (): AssistantModel => new ClaudeAssistantModel(
            client: new Client(apiKey: (string) config('services.anthropic.key')),
            model: (string) config('ascend.assistant.model'),
            effort: (string) config('ascend.assistant.effort'),
            briefing: (string) file_get_contents(resource_path('assistant/system-prompt.md')),
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        // The system status page (config/system-status.php): only listed admin emails, and only once verified,
        // because users can change their own email and User does not enforce verification on routes.
        Gate::define('view-system-status', fn (User $user): bool => $user->hasVerifiedEmail()
            && in_array(strtolower($user->email), (array) config('system-status.admins', []), true));
    }
}
