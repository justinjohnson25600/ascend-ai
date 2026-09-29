<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

function textAlertEnquiry(array $overrides = []): array
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

beforeEach(function () {
    Mail::fake();
    config([
        'ascend.sms.driver' => 'twilio',
        'ascend.sms.to' => '+447700900000',
        'services.twilio' => ['sid' => 'AC123', 'token' => 'secret', 'from' => '+447700900111'],
    ]);
});

test('an audit request is texted to the owner', function () {
    Http::fake(['api.twilio.com/*' => Http::response(['sid' => 'SM1'], 201)]);

    $this->postJson(route('contact.submit'), textAlertEnquiry())->assertOk();

    Http::assertSent(function (Request $request) {
        return $request->url() === 'https://api.twilio.com/2010-04-01/Accounts/AC123/Messages.json'
            && $request['To'] === '+447700900000'
            && $request['From'] === '+447700900111'
            && str_contains($request['Body'], 'New audit request from Jane Example, Example Ltd')
            && str_contains($request['Body'], 'Reply by email: jane@example.com');
    });
});

test('a quote request is texted too', function () {
    Http::fake(['api.twilio.com/*' => Http::response([], 201)]);

    $this->postJson(route('contact.submit'), textAlertEnquiry(['enquiry_type' => 'quote']))->assertOk();

    Http::assertSent(fn (Request $request) => str_contains($request['Body'], 'New quote request'));
});

test('general enquiries and client support are not texted', function (string $type) {
    Http::fake();

    $this->postJson(route('contact.submit'), textAlertEnquiry(['enquiry_type' => $type]))->assertOk();

    Http::assertNothingSent();
})->with(['general', 'client', 'partnership']);

test('a long message is cut short in the text', function () {
    Http::fake(['api.twilio.com/*' => Http::response([], 201)]);

    $this->postJson(route('contact.submit'), textAlertEnquiry(['message' => str_repeat('word ', 100)]))->assertOk();

    Http::assertSent(fn (Request $request) => mb_strlen($request['Body']) < 320 && str_contains($request['Body'], '…'));
});

test('a failed text never stops the enquiry being taken', function () {
    Http::fake(['api.twilio.com/*' => Http::response(['message' => 'down'], 500)]);

    $this->postJson(route('contact.submit'), textAlertEnquiry())->assertOk()->assertJson(['success' => true]);

    $this->assertDatabaseHas('contacts', ['email' => 'jane@example.com']);
});

test('nothing is sent until a mobile number is set', function () {
    Http::fake();
    config(['ascend.sms.to' => null]);

    $this->postJson(route('contact.submit'), textAlertEnquiry())->assertOk();

    Http::assertNothingSent();
});

test('the log driver writes the alert instead of sending it', function () {
    Http::fake();
    config(['ascend.sms.driver' => 'log']);

    $this->postJson(route('contact.submit'), textAlertEnquiry())->assertOk();

    Http::assertNothingSent();
});

test('spam trap submissions are not texted', function () {
    Http::fake();

    $this->postJson(route('contact.submit'), textAlertEnquiry(['website' => 'x']))->assertOk();

    Http::assertNothingSent();
});
