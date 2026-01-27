<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\NewsletterSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

final class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home')
            ->with('title', 'Home')
            ->with('description', 'Ascend AI builds SaaS companies from the ground up around artificial intelligence. Unbeatable economics. Infinite scalability. Margins that legacy competitors cannot match.');
    }

    public function about(): View
    {
        return view('pages.about')
            ->with('title', 'About Us')
            ->with('description', 'Learn about Ascend AI\'s philosophy and methodology for building AI-centric businesses that traditional companies cannot compete with.');
    }

    public function whatWeDo(): View
    {
        return view('pages.what-we-do')
            ->with('title', 'What We Do')
            ->with('description', 'Discover how Ascend AI builds SaaS companies with AI at their core—from market identification to autonomous operation.');
    }

    public function portfolio(): View
    {
        return view('pages.portfolio')
            ->with('title', 'Portfolio')
            ->with('description', 'Explore Ascend AI\'s portfolio of AI-centric companies disrupting legacy markets across finance, genetics, and business intelligence.');
    }

    public function workWithUs(): View
    {
        return view('pages.work-with-us')
            ->with('title', 'Work With Us')
            ->with('description', 'Partner with Ascend AI. Investment opportunities, joint ventures, and advisory services for building AI-centric businesses.');
    }

    public function contact(): View
    {
        return view('pages.contact')
            ->with('title', 'Contact')
            ->with('description', 'Get in touch with Ascend AI. We respond to all enquiries within 48 hours.');
    }

    public function privacyPolicy(): View
    {
        return view('pages.privacy-policy')
            ->with('title', 'Privacy Policy')
            ->with('description', 'Ascend AI privacy policy. How we collect, use, and protect your personal information.');
    }

    public function termsAndConditions(): View
    {
        return view('pages.terms-and-conditions')
            ->with('title', 'Terms & Conditions')
            ->with('description', 'Ascend AI terms and conditions of service.');
    }

    public function dashboard(): View
    {
        return view('dashboard')
            ->with('title', 'Dashboard')
            ->with('description', 'Your Ascend AI dashboard.');
    }

    public function submitContact(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'organisation' => ['nullable', 'string', 'max:255'],
            'enquiry_type' => ['required', 'in:investment,partnership,advisory,general'],
            'message' => ['required', 'string', 'min:50', 'max:5000'],
        ]);

        // Store in database
        Contact::create($validated);

        // Send email to admin
        Mail::to('justin@ascend-ai.co.uk')
            ->send(new ContactFormMail($validated));

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your enquiry. We will respond within 48 hours.',
        ]);
    }

    public function subscribeNewsletter(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        // Check if email already exists
        $existing = NewsletterSubscription::where('email', $validated['email'])->first();

        if ($existing) {
            if ($existing->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are already subscribed to our newsletter.',
                ], 409);
            }

            // Reactivate subscription
            $existing->update([
                'is_active' => true,
                'subscribed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Welcome back! You have been resubscribed to our newsletter.',
            ]);
        }

        // Create new subscription
        NewsletterSubscription::create([
            'email' => $validated['email'],
            'is_active' => true,
            'subscribed_at' => now(),
            'unsubscribe_token' => Str::random(64),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!',
        ]);
    }
}
