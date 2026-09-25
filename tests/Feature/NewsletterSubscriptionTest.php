<?php

declare(strict_types=1);

use App\Models\NewsletterSubscription;

test('a new email address is subscribed', function () {
    $response = $this->postJson(route('newsletter.subscribe'), ['email' => 'new@example.com', 'website' => '']);

    $response->assertOk()->assertJson(['success' => true]);

    $this->assertDatabaseHas('newsletter_subscriptions', [
        'email' => 'new@example.com',
        'is_active' => true,
    ]);

    expect(NewsletterSubscription::first()->unsubscribe_token)->toHaveLength(64);
});

test('an already active subscriber receives a conflict response', function () {
    NewsletterSubscription::create(['email' => 'dup@example.com', 'is_active' => true, 'subscribed_at' => now()]);

    $response = $this->postJson(route('newsletter.subscribe'), ['email' => 'dup@example.com']);

    $response->assertStatus(409)->assertJson(['success' => false]);
    expect(NewsletterSubscription::count())->toBe(1);
});

test('an inactive subscriber is reactivated', function () {
    NewsletterSubscription::create(['email' => 'back@example.com', 'is_active' => false, 'subscribed_at' => now()->subYear()]);

    $response = $this->postJson(route('newsletter.subscribe'), ['email' => 'back@example.com']);

    $response->assertOk()->assertJson(['success' => true]);
    expect(NewsletterSubscription::where('email', 'back@example.com')->first()->is_active)->toBeTrue();
});

test('an invalid email address is rejected', function () {
    $response = $this->postJson(route('newsletter.subscribe'), ['email' => 'not-an-email']);

    $response->assertUnprocessable()->assertJsonValidationErrors(['email']);
    expect(NewsletterSubscription::count())->toBe(0);
});

test('a subscription with the honeypot filled is silently discarded', function () {
    $response = $this->postJson(route('newsletter.subscribe'), ['email' => 'bot@example.com', 'website' => 'x']);

    $response->assertOk()->assertJson(['success' => true]);
    expect(NewsletterSubscription::count())->toBe(0);
});

test('the newsletter endpoint is rate limited', function () {
    foreach (range(1, 5) as $i) {
        $this->postJson(route('newsletter.subscribe'), ['email' => "sub{$i}@example.com"])->assertOk();
    }

    $this->postJson(route('newsletter.subscribe'), ['email' => 'sub6@example.com'])->assertStatus(429);
});
