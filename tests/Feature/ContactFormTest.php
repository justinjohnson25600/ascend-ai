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
        'message' => 'We run a small plumbing firm and the quotes are killing us.',
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

test('every new enquiry type is accepted', function (string $type) {
    Mail::fake();

    $this->postJson(route('contact.submit'), validEnquiry(['enquiry_type' => $type]))->assertOk();

    $this->assertDatabaseHas('contacts', ['enquiry_type' => $type]);
})->with(['audit', 'quote', 'client', 'partnership', 'general']);

test('the old venture studio enquiry types are rejected', function (string $type) {
    Mail::fake();

    $this->postJson(route('contact.submit'), validEnquiry(['enquiry_type' => $type]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['enquiry_type']);
})->with(['investment', 'advisory']);

test('the notification subject names the enquiry type in plain words', function () {
    Mail::fake();

    $this->postJson(route('contact.submit'), validEnquiry(['enquiry_type' => 'audit']))->assertOk();

    Mail::assertSent(ContactFormMail::class, function (ContactFormMail $mail) {
        return str_contains($mail->envelope()->subject, 'Book a free automation audit')
            && str_contains($mail->envelope()->subject, 'Jane Example');
    });
});

test('a twenty character message is long enough', function () {
    Mail::fake();

    $this->postJson(route('contact.submit'), validEnquiry(['message' => str_repeat('x', 20)]))->assertOk();
});

test('a message shorter than twenty characters is rejected', function () {
    Mail::fake();

    $response = $this->postJson(route('contact.submit'), validEnquiry(['message' => str_repeat('x', 19)]));

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
