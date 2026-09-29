<?php

declare(strict_types=1);

test('the contact page offers no booking when none is set up', function () {
    config(['ascend.booking_url' => null]);

    $this->get('/contact')->assertOk()
        ->assertDontSee('Rather pick a time now?')
        ->assertDontSee('Pick a time now');
});

test('the contact page offers self-booking once a booking page is set up', function () {
    config(['ascend.booking_url' => 'https://booking.example/ascend']);

    $this->get('/contact')->assertOk()
        ->assertSee('Rather pick a time now?')
        ->assertSee('Show available times')
        ->assertSee('Open the booking page in a new tab')
        ->assertSee('href="https://booking.example/ascend"', false)
        ->assertSee('Pick a time now');
});

test('the outside calendar does not load until the visitor asks for it', function () {
    config(['ascend.booking_url' => 'https://booking.example/ascend']);

    $this->get('/contact')->assertOk()->assertDontSee('<iframe src=', false);
});

test('a booking address that is not https is ignored', function () {
    config(['ascend.booking_url' => 'javascript:alert(1)']);

    $this->get('/contact')->assertOk()->assertDontSee('Rather pick a time now?')->assertDontSee('javascript:alert', false);
});
