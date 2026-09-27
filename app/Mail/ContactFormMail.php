<?php

declare(strict_types=1);

namespace App\Mail;

use App\Enums\EnquiryType;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $contactData
     */
    public function __construct(
        public array $contactData,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: sprintf(
                'New Ascend AI enquiry: %s from %s',
                $this->enquiryType()->label(),
                $this->contactData['name'],
            ),
            replyTo: [$this->contactData['email']],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
            with: ['enquiryLabel' => $this->enquiryType()->label()],
        );
    }

    private function enquiryType(): EnquiryType
    {
        return EnquiryType::tryFrom((string) ($this->contactData['enquiry_type'] ?? '')) ?? EnquiryType::General;
    }
}
