<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContactEnquiryRequest;
use App\Http\Requests\NewsletterSubscribeRequest;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\NewsletterSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

final class PageController extends Controller
{
    private const CONTACT_THANKS = 'Thank you for your enquiry. We will respond within 48 hours.';

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

    public function submitContact(ContactEnquiryRequest $request): JsonResponse
    {
        if ($request->isSpam()) {
            return $this->success(self::CONTACT_THANKS);
        }

        $validated = $request->validated();

        Contact::create($validated);

        // The enquiry is already safe in the database, so a mail outage must not
        // turn into an error for the visitor. Log it and let them see success.
        try {
            Mail::to(config('ascend.contact_to'))
                ->send(new ContactFormMail($validated));
        } catch (Throwable $exception) {
            Log::error('Contact enquiry notification failed to send.', [
                'email' => $validated['email'],
                'exception' => $exception,
            ]);
        }

        return $this->success(self::CONTACT_THANKS);
    }

    public function subscribeNewsletter(NewsletterSubscribeRequest $request): JsonResponse
    {
        if ($request->isSpam()) {
            return $this->success('Thank you for subscribing to our newsletter!');
        }

        $email = $request->validated('email');

        $existing = NewsletterSubscription::where('email', $email)->first();

        if ($existing?->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'You are already subscribed to our newsletter.',
            ], 409);
        }

        if ($existing) {
            $existing->update([
                'is_active' => true,
                'subscribed_at' => now(),
            ]);

            return $this->success('Welcome back! You have been resubscribed to our newsletter.');
        }

        NewsletterSubscription::create([
            'email' => $email,
            'is_active' => true,
            'subscribed_at' => now(),
            'unsubscribe_token' => Str::random(64),
        ]);

        return $this->success('Thank you for subscribing to our newsletter!');
    }

    private function success(string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
