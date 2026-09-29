<?php

declare(strict_types=1);

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/what-is-business-automation', [PageController::class, 'whatIsBusinessAutomation'])->name('what-is-business-automation');
Route::get('/solutions', [PageController::class, 'solutions'])->name('solutions');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/automation-ideas', [PageController::class, 'automationIdeas'])->name('automation-ideas');
Route::get('/your-data', [PageController::class, 'yourData'])->name('your-data');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [PageController::class, 'termsAndConditions'])->name('terms-and-conditions');

// Permanent redirects from the venture-studio site map (September 2026 repositioning)
Route::redirect('/what-we-do', '/solutions', 301);
Route::redirect('/work-with-us', '/how-it-works', 301);
Route::redirect('/portfolio', '/solutions', 301);

// Public form endpoints (rate limited per IP)
Route::post('/contact', [PageController::class, 'submitContact'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

Route::post('/newsletter/subscribe', [PageController::class, 'subscribeNewsletter'])
    ->middleware('throttle:5,1')
    ->name('newsletter.subscribe');

// Website assistant (enabled once ANTHROPIC_API_KEY is set)
Route::prefix('assistant')->name('assistant.')->group(function () {
    Route::get('/history', [AssistantController::class, 'history'])->name('history');
    Route::post('/messages', [AssistantController::class, 'message'])->middleware('throttle:20,1')->name('message');
    Route::post('/reset', [AssistantController::class, 'reset'])->name('reset');
});

// Dashboard (protected)
Route::get('/dashboard', [PageController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile (protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

require __DIR__.'/auth.php';
