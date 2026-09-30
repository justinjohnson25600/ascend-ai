<?php

declare(strict_types=1);

use App\Models\User;
use App\SystemStatus\Inventory;
use App\SystemStatus\StatusReport;
use Composer\InstalledVersions;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config(['system-status.admins' => ['admin@example.com']]);
    Cache::forget(StatusReport::CACHE_KEY);
});

function systemStatusAdmin(): User
{
    return User::factory()->create(['email' => 'admin@example.com']);
}

function installedMajor(string $package): string
{
    return strtok(ltrim((string) InstalledVersions::getPrettyVersion($package), 'v'), '.') ?: '0';
}

/**
 * Packagist, npm and endoflife.date, faked from this project's own files so the tests survive upgrades.
 * Every package's newest release is 99.1.0 (after a pre-release that must be skipped), with a safe update
 * (major.999.0) in the installed line of laravel/framework. laravel/framework and one npm package each have
 * advisories. Pass closures to switch Packagist or the security lookups off part way through a test (a second
 * Http::fake would not replace this one).
 */
function fakeSystemStatusRegistries(?Closure $packagistUp = null, ?Closure $securityUp = null): void
{
    $frameworkMajor = installedMajor('laravel/framework');
    $npmPackage = array_key_first(app(Inventory::class)->npmLocked());

    Http::fake(function (Request $request) use ($packagistUp, $securityUp, $frameworkMajor, $npmPackage) {
        $url = $request->url();
        $security = $securityUp === null || $securityUp();

        if (str_contains($url, 'repo.packagist.org/p2/')) {
            if ($packagistUp !== null && ! $packagistUp()) {
                return Http::response('Service unavailable', 503);
            }

            $name = str_replace(['https://repo.packagist.org/p2/', '.json'], '', $url);
            $versions = [['version' => 'v99.2.0-beta1'], ['version' => 'v99.1.0'], ['version' => 'v1.0.0']];

            if ($name === 'laravel/framework') {
                $versions[] = ['version' => 'v'.$frameworkMajor.'.999.0'];
            }

            return Http::response(['packages' => [$name => $versions]]);
        }

        if (str_contains($url, 'packagist.org/api/security-advisories')) {
            return $security ? Http::response(['advisories' => ['laravel/framework' => [
                ['title' => 'Test hole in the framework', 'severity' => 'high', 'cve' => 'CVE-2099-0001', 'link' => 'https://example.test/advisory', 'affectedVersions' => '>=1.0.0,<99.0.0'],
                ['title' => 'Old hole, already fixed', 'severity' => 'high', 'cve' => null, 'link' => null, 'affectedVersions' => '<0.1.0'],
                ['title' => 'Hole with a bad link', 'severity' => 'low', 'cve' => null, 'link' => 'javascript:alert(1)', 'affectedVersions' => '*'],
            ]]]) : Http::response('Service unavailable', 503);
        }

        if (str_contains($url, 'registry.npmjs.org/-/npm/v1/security/advisories/bulk')) {
            return $security ? Http::response([$npmPackage => [['title' => 'Test hole in an npm package', 'severity' => 'moderate', 'url' => 'https://example.test/npm', 'vulnerable_versions' => '<99.0.0']]])
                : Http::response('Service unavailable', 503);
        }

        if (str_contains($url, 'registry.npmjs.org/')) {
            return Http::response(['dist-tags' => ['latest' => '99.1.0'], 'versions' => ['99.1.0' => [], '99.2.0-beta.1' => [], '1.0.0' => []]]);
        }

        if (str_contains($url, 'endoflife.date/api/')) {
            return Http::response([
                ['cycle' => PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION, 'latest' => PHP_VERSION, 'eol' => '2030-12-31', 'support' => '2028-12-31'],
                ['cycle' => installedMajor('laravel/framework'), 'latest' => '99.0.0', 'eol' => '2031-02-24', 'support' => '2030-08-13'],
            ]);
        }

        return Http::response('Unexpected request', 500);
    });
}

test('guests are sent to log in', function () {
    $this->get('/admin/system-status')->assertRedirect(route('login'));
});

test('a logged-in user who is not on the admin list is refused', function () {
    $user = User::factory()->create(['email' => 'someone@example.com']);

    $this->actingAs($user)->get('/admin/system-status')->assertForbidden();
    $this->actingAs($user)->post('/admin/system-status/check')->assertForbidden();
});

test('a listed admin email that has not been verified is refused', function () {
    $user = User::factory()->unverified()->create(['email' => 'admin@example.com']);

    $this->actingAs($user)->get('/admin/system-status')->assertForbidden();
});

test('a blank admin list falls back to ADMIN_EMAIL', function () {
    $previous = [getenv('SYSTEM_STATUS_ADMINS'), getenv('ADMIN_EMAIL')];
    putenv('SYSTEM_STATUS_ADMINS=');
    putenv('ADMIN_EMAIL=Owner@Example.com');

    try {
        $config = require config_path('system-status.php');
    } finally {
        putenv($previous[0] === false ? 'SYSTEM_STATUS_ADMINS' : 'SYSTEM_STATUS_ADMINS='.$previous[0]);
        putenv($previous[1] === false ? 'ADMIN_EMAIL' : 'ADMIN_EMAIL='.$previous[1]);
    }

    expect($config['admins'])->toBe(['owner@example.com']);
});

test('before any check the page shows what is installed and says it has not been checked', function () {
    $this->actingAs(systemStatusAdmin())->get('/admin/system-status')
        ->assertOk()
        ->assertHeader('Cache-Control', 'no-store, private')
        ->assertSee('<meta name="robots" content="noindex, nofollow">', false)
        ->assertSee('System status')
        ->assertSee(PHP_VERSION)
        ->assertSee('laravel/framework')
        ->assertSee('Not checked online yet');
});

test('a check shows the safe update in the installed line, the newest release, and only the security problems that apply', function () {
    fakeSystemStatusRegistries();
    $admin = systemStatusAdmin();

    $this->actingAs($admin)->post('/admin/system-status/check')->assertRedirect(route('system-status'));

    $this->actingAs($admin)->get('/admin/system-status')
        ->assertOk()
        ->assertSee('v'.installedMajor('laravel/framework').'.999.0')
        ->assertSee('newest v99.1.0')
        ->assertDontSee('v99.2.0-beta1')
        ->assertSee('Test hole in the framework')
        ->assertSee('Test hole in an npm package')
        ->assertDontSee('Old hole, already fixed')
        ->assertSee('Hole with a bad link')
        ->assertDontSee('javascript:alert(1)', false)
        ->assertDontSee('Not checked online yet');
});

test('the copied text lists everything Claude Code needs to write the update prompts', function () {
    fakeSystemStatusRegistries();
    $this->actingAs(systemStatusAdmin())->post('/admin/system-status/check');

    $report = app(StatusReport::class);
    $text = $report->text($report->build());
    $constraint = json_decode((string) file_get_contents(base_path('composer.json')), true)['require']['laravel/framework'];

    expect($text)
        ->toContain('PHP '.PHP_VERSION.' (security fixes until 2030-12-31')
        ->toContain('Security problems (3 across 2 packages; full list on the page)')
        ->toContain('composer laravel/framework '.InstalledVersions::getPrettyVersion('laravel/framework').': 2 advisories (1 high, 1 low), e.g. "Test hole in the framework" CVE-2099-0001')
        ->toContain('- laravel/framework '.$constraint.': '.InstalledVersions::getPrettyVersion('laravel/framework').' -> v'.installedMajor('laravel/framework').'.999.0 (newest v99.1.0) [security]')
        ->toContain('Please give me the update prompts for this site, grouped and in order.');
});

test('when the security lookups fail, security is reported as not checked, never as none', function () {
    fakeSystemStatusRegistries(securityUp: fn () => false);
    $admin = systemStatusAdmin();
    $this->actingAs($admin)->post('/admin/system-status/check');

    $this->actingAs($admin)->get('/admin/system-status')
        ->assertOk()
        ->assertSee('security problems (not checked)')
        ->assertSee('Security problems could not be checked');

    $report = app(StatusReport::class);

    expect($report->text($report->build()))
        ->toContain('Security problems: not checked, the security lookups have not succeeded')
        ->not->toContain('- none found');
});

test('a failed lookup is reported, never hidden, and keeps the earlier results', function () {
    $admin = systemStatusAdmin();
    $packagistUp = true;
    fakeSystemStatusRegistries(function () use (&$packagistUp) {
        return $packagistUp;
    });

    $this->actingAs($admin)->post('/admin/system-status/check');

    $packagistUp = false;
    $this->actingAs($admin)->post('/admin/system-status/check');

    $this->actingAs($admin)->get('/admin/system-status')
        ->assertOk()
        ->assertSee('Some lookups failed on the last check')
        ->assertSee('could not be looked up on Packagist')
        ->assertSee('newest v99.1.0');
});

test('the admin dashboard links to the page, other users do not see the link', function () {
    $this->actingAs(systemStatusAdmin())->get('/dashboard')->assertSee(route('system-status'), false);
    $this->actingAs(User::factory()->create())->get('/dashboard')->assertDontSee(route('system-status'), false);
});

test('the daily command runs the same check', function () {
    fakeSystemStatusRegistries();

    $this->artisan('system-status:check')->assertExitCode(0);

    expect(Cache::get(StatusReport::CACHE_KEY))->toHaveKey('checked_at');
});
