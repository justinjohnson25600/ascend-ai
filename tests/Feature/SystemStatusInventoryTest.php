<?php

declare(strict_types=1);

use App\SystemStatus\Inventory;
use App\SystemStatus\Registry;
use App\SystemStatus\StatusReport;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

/**
 * A small fake site on disk: composer and npm manifests and locks, a git checkout and a build, so the
 * production-only paths can be tested without the real project's files.
 */
function systemStatusFixture(array $npmLock = ['axios' => '1.0.0'], bool $withLock = true): string
{
    $path = storage_path('framework/testing/system-status-'.uniqid());
    File::ensureDirectoryExists($path.'/.git/refs/heads');
    File::ensureDirectoryExists($path.'/.git/logs');
    File::ensureDirectoryExists($path.'/public/build/assets');

    File::put($path.'/composer.json', json_encode([
        'require' => ['php' => '^8.2', 'acme/app-lib' => '^2.0'],
        'require-dev' => ['acme/test-tool' => '^1.0'],
    ]));
    File::put($path.'/composer.lock', json_encode([
        'packages' => [['name' => 'acme/app-lib', 'version' => 'v2.1.0']],
        'packages-dev' => [['name' => 'acme/test-tool', 'version' => '1.4.0']],
    ]));
    File::put($path.'/package.json', json_encode(['devDependencies' => array_map(fn () => '^1.0.0', $npmLock)]));

    if ($withLock) {
        $packages = ['' => ['devDependencies' => array_map(fn () => '^1.0.0', $npmLock)]];

        foreach ($npmLock as $name => $version) {
            $packages['node_modules/'.$name] = ['version' => $version];
        }

        File::put($path.'/package-lock.json', json_encode(['lockfileVersion' => 3, 'packages' => $packages]));
    }

    File::put($path.'/.git/HEAD', "ref: refs/heads/main\n");
    File::put($path.'/.git/refs/heads/main', "0123456789abcdef0123456789abcdef01234567\n");
    File::put($path.'/.git/logs/HEAD', "0000000000000000000000000000000000000000 0123456789abcdef0123456789abcdef01234567 Owner <o@example.com> 1790000000 +0100\tpull: Fast-forward\n");
    File::put($path.'/public/build/manifest.json', json_encode(['resources/js/app.js' => ['file' => 'assets/app.js']]));
    File::put($path.'/public/build/assets/app.js', '');

    return $path;
}

afterEach(function () {
    foreach (File::glob(storage_path('framework/testing/system-status-*')) as $fixture) {
        File::deleteDirectory($fixture);
    }
});

test('on a production install without development packages, they show as not on this server and are not counted as drift', function () {
    $inventory = new Inventory(systemStatusFixture(), installed: ['acme/app-lib' => 'v2.1.0'], devInstalled: false);

    $packages = collect($inventory->composerPackages())->keyBy('name');

    expect($packages['acme/app-lib']['installed'])->toBe('v2.1.0')
        ->and($packages['acme/test-tool']['installed'])->toBeNull()
        ->and($packages->has('php'))->toBeFalse()
        ->and($inventory->drift()['lock_mismatches'])->toBe([])
        ->and($inventory->drift()['build_ok'])->toBeTrue()
        ->and($inventory->runtime()['dev_packages_installed'])->toBeFalse();
});

test('a package that differs from composer.lock is reported as drift', function () {
    $inventory = new Inventory(systemStatusFixture(), installed: ['acme/app-lib' => 'v2.0.0'], devInstalled: false);

    expect($inventory->drift()['lock_mismatches'])->toBe([['name' => 'acme/app-lib', 'locked' => 'v2.1.0', 'installed' => 'v2.0.0']]);
});

test('the deployed commit is read from .git without running git', function () {
    $inventory = new Inventory(systemStatusFixture(), installed: [], devInstalled: false);

    expect($inventory->deployment())->toBe(['commit' => '0123456', 'branch' => 'main', 'updated_at' => 1790000000, 'message' => 'pull: Fast-forward']);
});

test('missing build files are reported', function () {
    $path = systemStatusFixture();
    File::delete($path.'/public/build/assets/app.js');

    expect((new Inventory($path, installed: [], devInstalled: false))->drift()['build_ok'])->toBeFalse();
});

test('a missing package-lock.json is an error, not an all clear', function () {
    Cache::forget(StatusReport::CACHE_KEY);
    Http::fake(fn () => Http::response(['advisories' => []]));
    $inventory = new Inventory(systemStatusFixture(withLock: false), installed: [], devInstalled: false);

    $data = (new StatusReport($inventory, new Registry))->check();

    expect($data['advisories']['npm'])->toBeNull()
        ->and(implode(' ', $data['errors']))->toContain('package-lock.json is missing');
});

test('an npm security problem drops away once the fixed version is in package-lock.json, and the page says to check again', function () {
    Cache::forget(StatusReport::CACHE_KEY);
    Http::fake(function (Request $request) {
        if (str_contains($request->url(), 'advisories/bulk')) {
            return Http::response(['axios' => [['title' => 'Old axios hole', 'severity' => 'high', 'url' => 'https://example.test/a', 'vulnerable_versions' => '<1.20.0']]]);
        }

        return Http::response(['advisories' => []]);
    });

    $path = systemStatusFixture(['axios' => '1.0.0']);
    $report = new StatusReport(new Inventory($path, installed: [], devInstalled: false), new Registry);
    $report->check();

    expect(collect($report->build()['advisories'])->pluck('title')->all())->toBe(['Old axios hole']);

    // Deploy the fix: the lock now has axios 1.20.0.
    $fixed = new StatusReport(new Inventory(systemStatusFixture(['axios' => '1.20.0']), installed: [], devInstalled: false), new Registry);
    $after = $fixed->build();

    expect($after['advisories'])->toBe([])
        ->and($after['stale'])->toBeTrue();
});
