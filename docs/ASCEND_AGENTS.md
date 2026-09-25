# AGENTS.md - Ascend AI Agent Instructions

## Project Overview

**Ascend AI** - Laravel 12 AI/Technology Company Website

This document provides instructions for any AI agent working on this codebase.

---

## Technology Stack

| Layer | Technology | Version | Notes |
|-------|------------|---------|-------|
| Framework | Laravel | 12.x | Latest stable |
| Language | PHP | 8.4 | Strict types enabled |
| Database | PostgreSQL | 18 | JSONB support |
| Frontend | Blade + Tailwind + Alpine.js | Latest | No heavy frameworks |
| Build | Vite | Latest | HMR enabled |
| Authentication | Laravel Breeze | Latest | Simple, secure |

---

## Core Principles

### 1. AI-First Design Aesthetic
This is an AI company website. The design must reflect:
- Modern, futuristic aesthetic
- Dark mode as primary theme
- High contrast for accessibility
- Kinetic/animated elements
- Trust-building through transparency

### 2. Performance is Critical
AI users expect instant responses:
- Fast page loads (<2s)
- Smooth animations (60fps)
- Optimized assets (WebP, lazy loading)
- No blocking operations

### 3. Mobile-First Development
All features must work on mobile:
- Responsive design (Tailwind breakpoints)
- Touch-friendly interactions
- Readable on small screens
- No hover-only features

### 4. Accessibility Matters
- WCAG 2.1 AA minimum
- Keyboard navigation
- Screen reader support
- High contrast on dark mode
- ARIA labels where needed

---

## Code Standards

### PHP/Laravel
```php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;

final class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $contactService
    ) {}

    public function store(ContactRequest $request): RedirectResponse
    {
        $this->contactService->submit($request->validated());

        return redirect()
            ->back()
            ->with('success', 'Message sent successfully!');
    }
}
```

**Rules:**
- Use `declare(strict_types=1);` at top of every file
- Type hint all parameters and return values
- Use constructor property promotion
- Make classes `final` unless inheritance is intended
- Use dependency injection

### Database
```php
// Migration
Schema::create('contact_submissions', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email');
    $table->text('message');
    $table->boolean('is_processed')->default(false);
    $table->timestamps();
});

// Model
class ContactSubmission extends Model
{
    protected $fillable = ['name', 'email', 'message', 'is_processed'];

    protected $casts = [
        'is_processed' => 'boolean',
    ];
}
```

**Rules:**
- Use migrations for all schema changes
- Add timestamps() by default
- Use soft deletes where appropriate
- Index frequently queried columns

### Frontend - Blade Components
```php
{{-- resources/views/components/feature-card.blade.php --}}
@props([
    'title' => '',
    'description' => '',
    'icon' => null,
])

<div {{ $attributes->merge(['class' => 'feature-card']) }}>
    @if($icon)
        <div class="feature-card__icon">{{ $icon }}</div>
    @endif

    <h3 class="feature-card__title">{{ $title }}</h3>
    <p class="feature-card__description">{{ $description }}</p>
</div>
```

**Usage:**
```blade
<x-feature-card
    :title="'AI-Powered Analytics'"
    :description="'Get insights powered by machine learning'"
    :icon="'📊'"
    class="bg-slate-900 p-6 rounded-xl"
/>
```

**Rules:**
- Create reusable components
- Use `@props` for type safety
- Support attribute merging for flexibility
- Document required props

### Frontend - Alpine.js
```html
<div x-data="contactForm()">
    <form @submit.prevent="submit">
        <input
            type="email"
            x-model="email"
            :disabled="loading"
            placeholder="your@email.com"
            required
        >

        <button
            type="submit"
            :class="{ 'opacity-50': loading }"
            :disabled="loading"
        >
            <span x-show="!loading">Send Message</span>
            <span x-show="loading" class="animate-spin">⟳</span>
        </button>
    </form>
</div>

<script>
function contactForm() {
    return {
        email: '',
        loading: false,

        async submit() {
            this.loading = true;

            try {
                await this.$fetch('/contact', {
                    method: 'POST',
                    body: JSON.stringify({ email: this.email })
                });

                alert('Message sent!');
                this.email = '';
            } catch (error) {
                alert('Something went wrong.');
            } finally {
                this.loading = false;
            }
        }
    };
}
</script>
```

**Rules:**
- Keep Alpine components simple
- Use `x-data` for component state
- Show loading states for async operations
- Handle errors gracefully

### Frontend - Tailwind CSS
```html
<!-- Primary CTA -->
<button class="bg-gradient-to-r from-indigo-500 to-purple-600
               text-white font-semibold px-6 py-3 rounded-lg
               hover:from-indigo-600 hover:to-purple-700
               transition-all duration-300
               transform hover:scale-105
               shadow-lg shadow-indigo-500/50">
    Get Started Free
</button>

<!-- Card -->
<div class="bg-slate-900/50 backdrop-blur-sm
            border border-slate-700/50
            rounded-2xl p-8
            hover:border-indigo-500/50
            transition-colors duration-300">
    <!-- Content -->
</div>

<!-- Dark mode toggle -->
<div class="dark">
    <!-- Dark mode styles -->
</div>
```

**Color Palette (AI Theme):**
```css
/* Use these variables via Tailwind config or inline */

/* Primary */
bg-indigo-600       /* Main CTAs */
bg-slate-900        /* Dark backgrounds */
text-indigo-400     /* Accents */

/* Gradients */
from-indigo-500 to-purple-600    /* Primary gradient */
from-cyan-500 to-blue-600        /* Secondary gradient */

/* Effects */
backdrop-blur-sm               /* Glassmorphism */
shadow-indigo-500/50          /* Glowing shadows */
```

---

## File Structure

```
ascend-ai/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── AboutController.php
│   │   │   ├── SolutionsController.php
│   │   │   ├── ContactController.php
│   │   │   └── BlogController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   │       ├── ContactRequest.php
│   │       └── NewsletterRequest.php
│   ├── Models/
│   │   ├── ContactSubmission.php
│   │   ├── NewsletterSubscriber.php
│   │   └── BlogPost.php
│   ├── Services/
│   │   ├── ContactService.php
│   │   ├── NewsletterService.php
│   │   └── BlogService.php
│   └── Actions/
│       ├── SendContactEmail.php
│       └── SubscribeToNewsletter.php
├── resources/
│   ├── views/
│   │   ├── components/
│   │   │   ├── layout/
│   │   │   │   ├── header.blade.php
│   │   │   │   ├── footer.blade.php
│   │   │   │   └── nav.blade.php
│   │   │   ├── buttons/
│   │   │   │   ├── primary.blade.php
│   │   │   │   └── secondary.blade.php
│   │   │   ├── sections/
│   │   │   │   ├── hero.blade.php
│   │   │   │   ├── features.blade.php
│   │   │   │   └── cta.blade.php
│   │   │   └── ui/
│   │   │       ├── card.blade.php
│   │   │       └── badge.blade.php
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── minimal.blade.php
│   │   └── pages/
│   │       ├── home.blade.php
│   │       ├── about.blade.php
│   │       ├── solutions.blade.php
│   │       ├── contact.blade.php
│   │       └── blog/index.blade.php
│   ├── css/
│   │   └── app.css          # Tailwind imports
│   └── js/
│       ├── app.js           # Alpine.js setup
│       └── components/      # Page-specific JS
├── routes/
│   ├── web.php              # Public routes
│   └── api.php              # API routes (if any)
├── database/
│   ├── migrations/
│   └── seeders/
└── tests/
    ├── Feature/
    └── Unit/
```

---

## Common Patterns

### Creating a New Page

**1. Controller**
```bash
php artisan make:controller AboutController
```

```php
// app/Http/Controllers/AboutController.php
final class AboutController extends Controller
{
    public function index(): View
    {
        return view('pages.about');
    }
}
```

**2. Route**
```php
// routes/web.php
Route::get('/about', AboutController::class)->name('about');
```

**3. View**
```blade
{{-- resources/views/pages/about.blade.php --}}
<x-layout.app>
    <x-sections.hero
        :title="'About Ascend AI'"
        :subtitle="'Pioneering the future of artificial intelligence'"
    />

    <section class="py-20 bg-slate-900">
        <div class="container mx-auto px-6">
            <!-- Content -->
        </div>
    </section>
</x-layout.app>
```

### Creating a Reusable Component

```bash
# Create component file
touch resources/views/components/sections/hero.blade.php
```

```blade
{{-- resources/views/components/sections/hero.blade.php --}}
@props([
    'title' => '',
    'subtitle' => '',
    'ctaText' => 'Get Started',
    'ctaUrl' => '/contact',
    'background' => 'bg-slate-950',
])

<section class="{{ $background }} py-32 relative overflow-hidden">
    {{-- Background gradient effect --}}
    <div class="absolute inset-0 bg-gradient-to-br
                    from-indigo-500/10 via-transparent to-purple-500/10">
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-7xl font-bold
                       text-white mb-6
                       bg-gradient-to-r from-indigo-400 to-purple-400
                       bg-clip-text text-transparent">
                {{ $title }}
            </h1>

            @if($subtitle)
                <p class="text-xl text-slate-300 mb-10
                          max-w-2xl mx-auto">
                    {{ $subtitle }}
                </p>
            @endif

            <x-buttons.primary
                :text="$ctaText"
                :href="$ctaUrl"
            />
        </div>
    </div>
</section>
```

**Usage:**
```blade
<x-sections.hero
    :title="'Transform Your Business with AI'"
    :subtitle="'Leverage cutting-edge artificial intelligence to automate, optimize, and scale'"
    :ctaText="'Start Free Trial'"
    :ctaUrl="'/trial'"
/>
```

### Form Handling with Validation

```bash
php artisan make:request ContactRequest
```

```php
// app/Http/Requests/ContactRequest.php
final class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ];
    }
}
```

```php
// Controller
public function store(ContactRequest $request): RedirectResponse
{
    $submission = ContactSubmission::create($request->validated());

    SendContactEmail::dispatch($submission);

    return redirect()
        ->back()
        ->with('success', 'Thank you for your message!');
}
```

---

## Testing Requirements

### Feature Tests
```php
// tests/Feature/ContactFormTest.php
test('guest can submit contact form', function () {
    $response = $this->post('/contact', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Test message',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('contact_submissions', [
        'email' => 'john@example.com',
    ]);
});
```

### Component Tests
```php
test('hero component renders with props', function () {
    $view = $this->blade(
        '<x-sections.hero :title="$title" :subtitle="$subtitle" />',
        ['title' => 'Test Title', 'subtitle' => 'Test Subtitle']
    );

    $view->assertSee('Test Title');
    $view->assertSee('Test Subtitle');
});
```

---

## Security Checklist

- [ ] CSRF protection on all forms
- [ ] Input validation on all user inputs
- [ ] XSS prevention (Blade auto-escapes)
- [ ] SQL injection prevention (use Eloquent)
- [ ] Rate limiting on form submissions
- [ ] reCAPTCHA or similar bot protection
- [ ] Sanitize HTML if allowing user content
- [ ] Secure headers (CSP, X-Frame-Options)

---

## Performance Checklist

- [ ] Images optimized (WebP format, lazy loading)
- [ ] CSS/JS minified in production
- [ ] Font loading optimized
- [ ] Cache headers configured
- [ ] Database queries optimized
- [ ] No unnecessary dependencies
- [ ] Lazy load off-screen content

---

## Useful Commands

```bash
# Development
npm run dev              # Start Vite dev server
php artisan serve        # Start Laravel dev server

# Clear caches
php artisan optimize:clear

# Run tests
php artisan test

# Create components
php artisan make:component Buttons/Primary
php artisan make:middleware ...

# Database
php artisan migrate
php artisan migrate:fresh --seed
```

---

## Design Inspiration

Study these websites for AI company design patterns:
- **OpenAI** - Minimalist, content-focused
- **Anthropic** - Professional, research-oriented
- **Perplexity** - Bold gradients, kinetic type
- **DeepMind** - Research showcase, clean layouts

**Common Patterns:**
1. Hero sections with gradient text
2. Feature grids with icons
3. Dark mode with neon accents
4. Smooth scroll animations
5. Trust indicators (logos, testimonials)
6. Clear CTAs throughout

---

*Last Updated: 19 January 2026*
*Version: 1.0*
