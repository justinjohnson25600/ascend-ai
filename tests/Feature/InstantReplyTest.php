<?php

declare(strict_types=1);

use App\Mail\EnquiryReceivedMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

function enquiry(array $overrides = []): array
{
    return array_merge([
        'name' => 'Jane Example',
        'email' => 'jane@example.com',
        'organisation' => 'Example Ltd',
        'enquiry_type' => 'audit',
        'message' => 'We run a small plumbing firm and the quotes are killing us.',
        'website' => '',
    ], $overrides);
}

test('the person who sends an enquiry gets an instant reply', function () {
    Mail::fake();

    $this->postJson(route('contact.submit'), enquiry())->assertOk();

    Mail::assertSent(EnquiryReceivedMail::class, fn (EnquiryReceivedMail $mail) => $mail->hasTo('jane@example.com'));
});

test('the instant reply greets by first name and names the enquiry type', function () {
    $html = EnquiryReceivedMail::forEnquiry(enquiry())->render();

    expect($html)->toContain('Hi Jane,')
        ->toContain('Book a free automation audit')
        ->toContain('This reply went out automatically');
});

test('a name that does not look like a name gets a neutral greeting', function (string $name) {
    $html = EnquiryReceivedMail::forEnquiry(enquiry(['name' => $name]))->render();

    expect($html)->toContain('Hi there,')->not->toContain('spam.example');
})->with(['Cheap-pills-at-spam.example', 'http://spam.example', '12345']);

test('the instant reply never repeats the visitor\'s message back', function () {
    $html = EnquiryReceivedMail::forEnquiry(enquiry(['message' => 'Visit spam.example for amazing offers, act now today']))->render();

    expect($html)->not->toContain('spam.example');
});

test('the instant reply comes from us and answers go to the enquiries mailbox', function () {
    config(['ascend.contact_to' => 'inbox@example.test']);

    $mail = EnquiryReceivedMail::forEnquiry(enquiry());

    expect($mail->envelope()->subject)->toBe("Thanks, we've got your enquiry");
    $mail->assertHasReplyTo('inbox@example.test');
});

test('the booking link appears only when online booking is set up', function () {
    config(['ascend.booking_url' => null]);
    expect(EnquiryReceivedMail::forEnquiry(enquiry())->render())->not->toContain('Pick a time');

    config(['ascend.booking_url' => 'https://booking.example/ascend']);
    expect(EnquiryReceivedMail::forEnquiry(enquiry())->render())
        ->toContain('Pick a time')
        ->toContain('https://booking.example/ascend');
});

test('the same address gets at most one instant reply a day', function () {
    Mail::fake();
    Contact::create(['name' => 'Jane', 'email' => 'jane@example.com', 'enquiry_type' => 'general', 'message' => str_repeat('x', 30)]);

    $this->postJson(route('contact.submit'), enquiry())->assertOk();

    Mail::assertNotSent(EnquiryReceivedMail::class);
});

test('an earlier enquiry more than a day ago does not block the instant reply', function () {
    Mail::fake();
    $old = Contact::create(['name' => 'Jane', 'email' => 'jane@example.com', 'enquiry_type' => 'general', 'message' => str_repeat('x', 30)]);
    $old->forceFill(['created_at' => now()->subDays(2)])->save();

    $this->postJson(route('contact.submit'), enquiry())->assertOk();

    Mail::assertSent(EnquiryReceivedMail::class);
});

test('spam trap submissions get no instant reply', function () {
    Mail::fake();

    $this->postJson(route('contact.submit'), enquiry(['website' => 'x']))->assertOk();

    Mail::assertNotSent(EnquiryReceivedMail::class);
});
