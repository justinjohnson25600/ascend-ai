<?php

declare(strict_types=1);

namespace App\Support;

final class Booking
{
    /**
     * The public page where visitors book a free audit, or null when online booking is not set up.
     * Only https addresses are accepted, so the value is safe to use as a link and an iframe source.
     */
    public static function url(): ?string
    {
        $url = config('ascend.booking_url');

        if (! is_string($url) || ! str_starts_with($url, 'https://') || filter_var($url, FILTER_VALIDATE_URL) === false) {
            return null;
        }

        return $url;
    }
}
