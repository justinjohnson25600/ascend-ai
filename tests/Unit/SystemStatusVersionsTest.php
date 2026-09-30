<?php

declare(strict_types=1);

use App\SystemStatus\Versions;

test('versions are normalised without a leading v', function () {
    expect(Versions::normalise('v12.47.0'))->toBe('12.47.0')
        ->and(Versions::normalise(' 1.6.12 '))->toBe('1.6.12')
        ->and(Versions::normalise(null))->toBeNull();
});

test('an update is classified by whether it crosses a major version', function (?string $installed, ?string $latest, string $status, ?string $newestInLine = null) {
    expect(Versions::classify($installed, $latest, $newestInLine))->toBe($status);
})->with([
    'same version' => ['v12.47.0', 'v12.47.0', 'current'],
    'newer patch' => ['7.3.1', '7.3.6', 'update'],
    'newer minor' => ['v2.3.8', 'v2.4.2', 'update'],
    'newer major' => ['v12.47.0', 'v13.34.0', 'major'],
    'zero major, newer minor is breaking' => ['0.52.0', '0.60.1', 'major'],
    'zero major, newer patch' => ['0.52.0', '0.52.3', 'update'],
    'installed is ahead' => ['2.0.0', '1.9.0', 'current'],
    'latest unknown' => ['1.0.0', null, 'unknown'],
    'not installed' => [null, '1.0.0', 'not-installed'],
    'newer major, but a safe update in the installed line first' => ['v12.47.0', 'v13.34.0', 'update', 'v12.69.3'],
    'newer major, installed line already at its newest' => ['v12.69.3', 'v13.34.0', 'major', 'v12.69.3'],
    'development branch' => ['dev-main', 'v2.0.0', 'unknown'],
    'branch alias' => ['12.x-dev', 'v13.0.0', 'unknown'],
]);

test('a version belongs to its major line, or its minor line below 1.0', function (string $version, string $line) {
    expect(Versions::line($version))->toBe($line);
})->with([
    ['v12.47.0', '12'],
    ['0.52.3', '0.52'],
    ['3', '3'],
]);

test('only plain numbered versions count as releases', function (string $version, bool $release) {
    expect(Versions::isRelease($version))->toBe($release);
})->with([
    ['v1.2.3', true],
    ['1.2', true],
    ['2.0.0-beta1', false],
    ['1.0.0-rc.1', false],
    ['dev-main', false],
]);

test('packagist affected version ranges are matched', function (string $version, string $range, bool $affected) {
    expect(Versions::affected($version, $range))->toBe($affected);
})->with([
    'inside a range' => ['7.15.0', '>=7.0.0,<7.15.2', true],
    'at the fixed version' => ['7.15.2', '>=7.0.0,<7.15.2', false],
    'second alternative' => ['8.0.0', '>=8.0.0,<8.0.1|<7.15.2', true],
    'outside every alternative' => ['8.0.1', '>=8.0.0,<8.0.1|<7.15.2', false],
    'leading v on the installed version' => ['v12.10.0', '>=12.0.0,<12.18.0', true],
    'spaces and upper bound inclusive' => ['1.2.3', '>= 1.0.0, <= 1.2.3', true],
    'exact version' => ['2.1.0', '==2.1.0', true],
    'wildcard' => ['5.4.9', '5.4.*', true],
    'wildcard miss' => ['5.5.0', '5.4.*', false],
    'everything' => ['9.9.9', '*', true],
    'branch alias counts as the newest of its line' => ['12.x-dev', '>=12.0.0,<12.18.0', false],
    'branch alias inside an open range' => ['12.x-dev', '>=12.0.0', true],
]);

test('a development branch counts as affected, so nothing is hidden', function () {
    expect(Versions::affected('dev-main', '<1.0.0'))->toBeTrue();
});

test('a range that cannot be read counts as affected, so nothing is hidden', function () {
    expect(Versions::affected('1.0.0', 'something odd'))->toBeTrue();
});
