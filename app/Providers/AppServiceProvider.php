<?php

namespace App\Providers;

use App\Services\Sms\LogSmsSender;
use App\Services\Sms\SmsSender;
use App\Services\Sms\TwilioSmsSender;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
