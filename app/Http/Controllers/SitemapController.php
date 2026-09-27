<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;

final class SitemapController extends Controller
{
    public function index(): Response
    {
        $today = now()->format('Y-m-d');

        $pages = [
            ['home', 'weekly', '1.0'],
            ['solutions', 'monthly', '0.9'],
            ['how-it-works', 'monthly', '0.9'],
            ['about', 'monthly', '0.7'],
            ['contact', 'monthly', '0.8'],
            ['privacy-policy', 'yearly', '0.3'],
            ['terms-and-conditions', 'yearly', '0.3'],
        ];

        $urls = array_map(fn (array $page) => [
            'loc' => route($page[0]),
            'lastmod' => $today,
            'changefreq' => $page[1],
            'priority' => $page[2],
        ], $pages);

        return response()->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'text/xml');
    }
}
