<?php

declare(strict_types=1);

namespace App\Enums;

enum EnquiryType: string
{
    case Audit = 'audit';
    case Quote = 'quote';
    case Client = 'client';
    case Partnership = 'partnership';
    case General = 'general';

    public function label(): string
    {
        return match ($this) {
            self::Audit => 'Book a free automation audit',
            self::Quote => 'Get a quote for a specific project',
            self::Client => "I'm an existing client",
            self::Partnership => 'Partner or refer clients',
            self::General => 'Something else',
        };
    }

    /**
     * How a text alert to the owner describes this enquiry, or null when it should not trigger one.
     * Only new business is texted; everything else waits for the inbox.
     */
    public function alertLabel(): ?string
    {
        return match ($this) {
            self::Audit => 'audit request',
            self::Quote => 'quote request',
            default => null,
        };
    }

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
