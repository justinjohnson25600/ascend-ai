<?php

declare(strict_types=1);

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

function validEnquiry(array $overrides = []): array
{
    return array_merge([
        'name' => 'Jane Example',
        'email' => 'jane@example.com',
        'organisation' => 'Example Ltd',
        'enquiry_type' => 'general',
        'message' => str_repeat('This is a sufficiently long enquiry message. ', 3),
        'website' => '',
    ], $overrides);
}

test('a valid enquiry is stored and emailed to the configured recipient', function () {
    Mail::fake();
    config(['ascend.contact_to' => 'inbox@example.test']);

    $response = $this->postJson(route('contact.submit'), validEnquiry());

    $response->assertOk()->assertJson(['success' => true]);

    $this->assertDatabaseHas('contacts', [
        'email' => 'jane@example.com',
        'enquiry_type' => 'general',
    ]);

    Mail::assertSent(ContactFormMail::class, fn (ContactFormMail $mail) => $mail->hasTo('inbox@example.test'));
});

test('a message shorter than fifty characters is rejected', function () {
    Mail::fake();

    $response = $this->postJson(route('contact.submit'), validEnquiry(['message' => 'Too short.']));

    $response->assertUnprocessable()->assertJsonValidationErrors(['message']);
    expect(Contact::count())->toBe(0);
    Mail::assertNothingSent();
});

test('a submission with the honeypot filled is silently discarded', function () {
    Mail::fake();

    $response = $this->postJson(route('contact.submit'), validEnquiry(['website' => 'https://spam.example']));

    $response->assertOk()->assertJson(['success' => true]);
    expect(Contact::count())->toBe(0);
    Mail::assertNothingSent();
});

test('the enquiry is still stored when the email fails to send', function () {
    Mail::shouldReceive('to')->once()->andThrow(new RuntimeException('SMTP unavailable'));

    $response = $this->postJson(route('contact.submit'), validEnquiry());

    $response->assertOk()->assertJson(['success' => true]);
    $this->assertDatabaseHas('contacts', ['email' => 'jane@example.com']);
});

test('the contact endpoint is rate limited', function () {
    Mail::fake();

    foreach (range(1, 5) as $i) {
        $this->postJson(route('contact.submit'), validEnquiry(['email' => "jane{$i}@example.com"]))->assertOk();
    }

    $this->postJson(route('contact.submit'), validEnquiry())->assertStatus(429);
});
