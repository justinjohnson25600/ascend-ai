# CLAUDE.md - Ascend AI Project Instructions

## Project Overview

**Ascend AI** is a modern AI/technology company website built with Laravel 12.

### Vision & Purpose
- [To be defined - awaiting specification documents]

### Target Users
- [To be defined - awaiting specification documents]

---

## Technology Stack

| Layer | Technology | Version |
|-------|------------|---------|
| Framework | Laravel | 12.x |
| Language | PHP | 8.4 |
| Database | PostgreSQL | 18 |
| Frontend | Blade + Tailwind CSS + Alpine.js | Latest |
| Build Tool | Vite | Latest |
| Authentication | Laravel Breeze | Latest |

---

## Architecture Decisions

### Project Structure
```
ascend-ai/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   ├── Services/
│   ├── Actions/
│   └── Traits/
├── resources/
│   ├── views/
│   │   ├── components/      # Reusable Blade components
│   │   ├── layouts/         # Base layouts
│   │   └── pages/           # Page templates
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   └── api.php
└── database/
    ├── migrations/
    └── seeders/
```

### Service Layer Pattern
- Business logic lives in `app/Services/`
- Use Actions for single-purpose operations
- Controllers remain thin, delegating to Services

### Frontend Architecture
- **Blade Components**: Reusable UI elements
- **Alpine.js**: Lightweight interactivity (no heavy framework needed)
- **Tailwind CSS**: Utility-first styling with AI-inspired theme
- **Vite**: Fast asset building with HMR

---

## Design System & Theme

### AI/Tech Company Aesthetic (2026 Trends)

#### Color Palette
```css
/* Primary - High Contrast Tech */
--ai-blue: #1e40af;        /* Trust, intelligence */
--neon-accent: #6366f1;    /* Innovation highlight */
--tech-black: #0f172a;     /* Sophisticated dark mode */

/* Secondary - Organic Balance */
--ai-green: #10b981;       /* Natural counterbalance */
--ai-purple: #8b5cf6;      /* Creativity */

/* Neutrals */
--gray-50: #f9fafb;
--gray-900: #111827;

/* Semantic */
--success: #10b981;
--warning: #f59e0b;
--error: #ef4444;
--info: #3b82f6;
```

#### Typography
- **Headings**: Inter or Plus Jakarta Sans (modern, clean)
- **Body**: Inter (excellent readability)
- **Code/Technical**: JetBrains Mono (monospace)

```css
font-family: 'Inter', system-ui, sans-serif;
font-feature-settings: 'cv11', 'ss01';
```

#### Design Patterns
1. **Dark Mode First** - 80% of AI companies use dark themes
2. **Minimalist + Kinetic** - Clean layouts with animated elements
3. **High Contrast** - Essential for accessibility on dark backgrounds
4. **Glassmorphism** - Subtle transparency effects
5. **Gradient Accents** - Neon/glowing highlights on CTAs

#### Animation Principles
- Purposeful micro-interactions
- Smooth transitions (300-500ms)
- Kinetic typography for headlines
- Loading states for AI operations

---

## Naming Conventions

### Routes
```php
// Public pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/solutions', [SolutionsController::class, 'index'])->name('solutions');

// API routes (if applicable)
Route::prefix('api/v1')->group(function () {
    Route::apiResource('contacts', ContactController::class);
});
```

### Database
- Tables: `snake_case` plural (e.g., `contact_submissions`, `newsletter_subscribers`)
- Columns: `snake_case` (e.g., `created_at`, `is_published`)
- Foreign keys: `{table}_id` (e.g., `user_id`)

### Models
- Singular PascalCase: `ContactSubmission`, `NewsletterSubscriber`
- Use associated factories for testing

### Blade Components
- kebab-case: `<x-hero-section />`, `<x-feature-card />`
- Slot naming: `heading`, `content`, `actions`

---

## Coding Standards

### PHP/Laravel
- Follow PSR-12 coding standards
- Use strict types: `declare(strict_types=1);`
- Type hint all parameters and return values
- Use Laravel's built-in features (Eloquent, Collections, Validation)

### Form Requests
```php
class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }
}
```

### Services
```php
class ContactService
{
    public function __construct(
        private readonly Mailer $mailer
    ) {}

    public function submitContact(array $data): void
    {
        // Business logic here
        $submission = ContactSubmission::create($data);

        $this->mailer->send(new ContactNotification($submission));
    }
}
```

### Frontend
- Use Tailwind utility classes
- Alpine.js for interactivity (data binding, events)
- Create reusable Blade components
- Ensure mobile responsiveness (mobile-first)
- Follow accessibility guidelines (ARIA labels, keyboard navigation)

---

## What NOT to Do (Critical Constraints)

- ❌ DO NOT add features without explicit approval
- ❌ DO NOT refactor existing code unless requested
- ❌ DO NOT add logging/monitoring unless specified
- ❌ DO NOT change authentication logic without review
- ❌ DO NOT use heavy frontend frameworks (React/Vue) unless approved
- ❌ DO NOT break dark mode compatibility
- ❌ DO NOT ignore accessibility (WCAG 2.1 AA minimum)
- ❌ DO NOT use inline styles - use Tailwind classes
- ❌ DO NOT create components that aren't reusable
- ❌ DO NOT skip testing for user-facing features

---

## Development Workflow

### Before Starting Work
1. Check if feature already exists
2. Verify the request matches project goals
3. Plan component reusability
4. Consider dark mode implications
5. Think about mobile experience

### Creating a New Page
```bash
# 1. Create controller
php artisan make:controller AboutController

# 2. Create view
touch resources/views/pages/about.blade.php

# 3. Add route
# Add to routes/web.php

# 4. Create Blade components if needed
touch resources/views/components/feature-card.blade.php
```

### Testing
```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=ContactTest

# Run with coverage
php artisan test --coverage
```

### Asset Building
```bash
# Development
npm run dev

# Production
npm run build

# Watch for changes
npm run dev -- --watch
```

---

## AI-Specific Considerations

### AI Operation UI Patterns
- Always show loading states for AI operations
- Provide progress feedback for long-running tasks
- Handle errors gracefully with user-friendly messages
- Implement rate limiting for AI endpoints (if applicable)

### Performance
- Lazy load AI components
- Use queues for heavy operations
- Implement caching where appropriate
- Optimize images (WebP format)

### Trust & Transparency
- Include security badges
- Showcase technical capabilities
- Provide clear privacy policy
- Display testimonials/social proof

---

## Sources & References

### Design Inspiration
- [OpenAI](https://openai.com) - Minimalist, content-focused
- [Anthropic](https://anthropic.com) - Professional, research-oriented
- [Perplexity](https://perplexity.ai) - Bold, modern aesthetic

### Documentation
- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [Alpine.js](https://alpinejs.dev/)

---

*Last Updated: 19 January 2026*
*Version: 1.0 - Initial Draft*
