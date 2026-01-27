<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            [
                'loc' => url('/'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('about'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('what-we-do'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('portfolio'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ],
            [
                'loc' => route('work-with-us'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ],
            [
                'loc' => route('contact'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ],
            [
                'loc' => route('privacy-policy'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'yearly',
                'priority' => '0.3',
            ],
            [
                'loc' => route('terms-and-conditions'),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'yearly',
                'priority' => '0.3',
            ],
        ];

        return response()->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'text/xml');
    }
}
