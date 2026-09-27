<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\EnquiryType;
use App\Http\Requests\ContactEnquiryRequest;
use App\Http\Requests\NewsletterSubscribeRequest;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\NewsletterSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

final class PageController extends Controller
{
    private const CONTACT_THANKS = 'Thanks. We will reply within one working day.';

    public function home(): View
    {
        return view('pages.home')
            ->with('title', 'AI Automation Built for Small Businesses')
            ->with('description', 'Ascend AI builds AI automation around the way your small business already works. Enquiries, quotes, scheduling, admin. Delivered in stages and kept running. Book a free automation audit.');
    }

    public function solutions(): View
    {
        return view('pages.solutions')
            ->with('title', 'What We Automate')
            ->with('description', 'Enquiries, quotes, scheduling, customer questions, paperwork and reporting. See the kinds of work Ascend AI automates for small businesses, built around how you already operate.');
    }

    public function howItWorks(): View
    {
        return view('pages.how-it-works')
            ->with('title', 'How It Works and What It Costs')
            ->with('description', 'Free audit, fixed-price stages, then a monthly fee to keep it running. How Ascend AI builds and prices AI automation for small businesses.');
    }

    public function about(): View
    {
        return view('pages.about')
            ->with('title', 'About Ascend AI')
            ->with('description', 'Ascend AI builds AI automation for small businesses because we run small businesses too. Who we are, how we work, and what we believe about automation.');
    }

    public function contact(Request $request): View
    {
        $requested = (string) $request->query('type', EnquiryType::Audit->value);

        return view('pages.contact')
            ->with('title', 'Book a Free Automation Audit')
            ->with('description', 'Book a free 30 minute automation audit with Ascend AI, or send us a question. We reply within one working day.')
            ->with('enquiryTypes', EnquiryType::cases())
            ->with('selectedType', (EnquiryType::tryFrom($requested) ?? EnquiryType::Audit)->value);
    }

    public function privacyPolicy(): View
    {
        return view('pages.privacy-policy')
            ->with('title', 'Privacy Policy')
            ->with('description', 'How Ascend AI collects, uses and protects personal information, for website visitors, newsletter subscribers and clients.');
    }

    public function termsAndConditions(): View
    {
        return view('pages.terms-and-conditions')
            ->with('title', 'Terms and Conditions')
            ->with('description', 'The terms on which Ascend AI provides automation audits, development and ongoing services to small businesses.');
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
            return $this->success("You're on the list. One email a month.");
        }

        $email = $request->validated('email');

        $existing = NewsletterSubscription::where('email', $email)->first();

        if ($existing?->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'You are already on the list.',
            ], 409);
        }

        if ($existing) {
            $existing->update([
                'is_active' => true,
                'subscribed_at' => now(),
            ]);

            return $this->success("Welcome back. You're on the list again.");
        }

        NewsletterSubscription::create([
            'email' => $email,
            'is_active' => true,
            'subscribed_at' => now(),
            'unsubscribe_token' => Str::random(64),
        ]);

        return $this->success("You're on the list. One email a month.");
    }

    private function success(string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
