<?php

declare(strict_types=1);

namespace App\Mail;

use App\Enums\EnquiryType;
use App\Support\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * The instant reply sent to whoever fills in the contact form.
 *
 * It deliberately carries nothing the visitor typed except a first name that passes a strict
 * check, so the form cannot be used to deliver someone else's text to an address they enter.
 */
final class EnquiryReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $greetingName,
        public readonly string $enquiryLabel,
        public readonly ?string $bookingUrl,
    ) {}

    /**
     * @param  array<string, mixed>  $enquiry  validated contact form data
     */
    public static function forEnquiry(array $enquiry): self
    {
        $type = EnquiryType::tryFrom((string) ($enquiry['enquiry_type'] ?? '')) ?? EnquiryType::General;

        return new self(
            greetingName: self::firstName((string) ($enquiry['name'] ?? '')) ?? 'there',
            enquiryLabel: $type->label(),
            bookingUrl: Booking::url(),
        );
    }

    /**
     * The first word of the name, only if it looks like a person's name.
     */
    public static function firstName(string $name): ?string
    {
        $first = strtok(trim($name), " \t");

        return $first !== false && preg_match("/^\p{Lu}?[\p{L}'’-]{1,29}$/u", $first) === 1
            ? mb_convert_case($first, MB_CASE_TITLE)
            : null;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Thanks, we've got your enquiry",
            replyTo: [config('ascend.contact_to')],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.enquiry-received',
            text: 'emails.enquiry-received-text',
        );
    }
}
