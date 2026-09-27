<?php

declare(strict_types=1);

test('the home page leads with the automation promise', function () {
    $this->get('/')->assertOk()->assertSee('Run your business on autopilot, not overtime.');
});

test('the solutions page is served', function () {
    $this->get('/solutions')->assertOk()->assertSee('What we automate');
});

test('the how it works page is served', function () {
    $this->get('/how-it-works')->assertOk()->assertSee('How it works, and what it costs');
});

test('the about page is served', function () {
    $this->get('/about')->assertOk()->assertSee('Built by people who run small businesses');
});

test('old venture studio urls redirect permanently', function (string $from, string $to) {
    $this->get($from)->assertStatus(301)->assertRedirect($to);
})->with([
    ['/what-we-do', '/solutions'],
    ['/work-with-us', '/how-it-works'],
    ['/portfolio', '/solutions'],
]);

test('the sitemap lists the new pages and not the old ones', function () {
    $response = $this->get('/sitemap.xml')->assertOk();

    $response->assertSee(url('/solutions'))
        ->assertSee(url('/how-it-works'))
        ->assertDontSee(url('/portfolio'))
        ->assertDontSee(url('/what-we-do'));
});

test('unknown urls show the branded 404 page', function () {
    $this->get('/this-page-does-not-exist')->assertNotFound()->assertSee("That page isn't here", false);
});

test('the contact form preselects the enquiry type from the query string', function () {
    $this->get('/contact?type=quote')->assertOk()
        ->assertSee('value="quote" selected', false);
});

test('the contact form defaults to the audit enquiry type', function () {
    $this->get('/contact')->assertOk()
        ->assertSee('value="audit" selected', false);
});

test('the legal pages carry the registered address', function (string $path) {
    $this->get($path)->assertOk()->assertSee('Matrix House');
})->with(['/privacy-policy', '/terms-and-conditions']);

test('the what is business automation page is served and linked from the menu', function () {
    $this->get('/what-is-business-automation')->assertOk()
        ->assertSee('What is business automation?')
        ->assertSee('What if your emails answered themselves');

    $this->get('/')->assertSee('What is Business Automation?');
});

test('the sitemap lists the explainer page', function () {
    $this->get('/sitemap.xml')->assertSee(url('/what-is-business-automation'));
});

test('the home hero is a carousel that opens on what business automation is', function () {
    $this->get('/')->assertOk()
        ->assertSee('aria-roledescription="carousel"', false)
        ->assertSee('What is business automation?')
        ->assertSee('Run your business on autopilot, not overtime.')
        ->assertSee('Every enquiry answered in minutes, not days.');
});
