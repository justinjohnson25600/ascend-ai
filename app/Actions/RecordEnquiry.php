<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\EnquiryType;
use App\Mail\ContactFormMail;
use App\Mail\EnquiryReceivedMail;
use App\Models\Contact;
use App\Services\Sms\SmsSender;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

/**
 * Everything that happens when someone gets in touch, whether through the contact form or the
 * website assistant: store it, email the enquiries mailbox, send the visitor an instant reply,
 * and text the owner about new business. Once stored, no notification failure reaches the visitor.
 */
final class RecordEnquiry
{
    public function __construct(
        private readonly SmsSender $sms,
    ) {}

    /**
     * @param  array{name: string, email: string, organisation?: ?string, enquiry_type: string, message: string}  $enquiry
     */
    public function handle(array $enquiry): Contact
    {
        $contact = Contact::create($enquiry);

        $this->attempt(
            fn () => Mail::to(config('ascend.contact_to'))->send(new ContactFormMail($enquiry)),
            'Contact enquiry notification failed to send.',
            $enquiry['email'],
        );

        // At most one instant reply per address per day, so the form cannot be used to flood
        // someone's inbox. The row just stored counts as one.
        $recentFromSameAddress = Contact::where('email', $enquiry['email'])
            ->where('created_at', '>=', now()->subDay())
            ->count();

        if ($recentFromSameAddress === 1) {
            $this->attempt(
                fn () => Mail::to($enquiry['email'])->send(EnquiryReceivedMail::forEnquiry($enquiry)),
                'Instant reply to an enquiry failed to send.',
                $enquiry['email'],
            );
        }

        $this->textOwner($enquiry);

        return $contact;
    }

    /**
     * @param  array<string, mixed>  $enquiry
     */
    private function textOwner(array $enquiry): void
    {
        $label = EnquiryType::tryFrom((string) $enquiry['enquiry_type'])?->alertLabel();
        $to = config('ascend.sms.to');

        if ($label === null || ! is_string($to) || $to === '') {
            return;
        }

        $who = Str::limit((string) $enquiry['name'], 60, '…');
        $business = trim((string) ($enquiry['organisation'] ?? ''));

        if ($business !== '') {
            $who .= ', '.Str::limit($business, 60, '…');
        }

        $excerpt = Str::limit(Str::squish((string) $enquiry['message']), 110, '…');

        $this->attempt(
            fn () => $this->sms->send($to, "New {$label} from {$who}: \"{$excerpt}\" Reply by email: {$enquiry['email']}"),
            'Text alert to the owner failed to send.',
            (string) $enquiry['email'],
        );
    }

    private function attempt(callable $send, string $failureMessage, string $email): void
    {
        try {
            $send();
        } catch (Throwable $exception) {
            Log::error($failureMessage, ['email' => $email, 'exception' => $exception]);
        }
    }
}
