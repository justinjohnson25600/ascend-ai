# ASCEND AI Website Build Instructions

## Technical Specification & Implementation Guide

### For AI Code Assistants (Claude-Code, Codex, GLM, Cursor, etc.)

---

## Document Purpose

This document provides complete instructions for building the Ascend AI corporate website. It should be used in conjunction with the companion document `ASCEND_AI_CONTENT_BLUEPRINT.md` which contains all copy, messaging, and content specifications.

---

## Project Overview

| Attribute | Value |
|-----------|-------|
| **Project Name** | Ascend AI Corporate Website |
| **Domain** | ascend-ai.co.uk |
| **Type** | Corporate brochure website with contact functionality |
| **Pages** | 8 total |

**Pages:**
1. Home (Landing Page)
2. About Us
3. What We Do
4. Portfolio (Case Studies)
5. Work With Us
6. Contact
7. Privacy Policy
8. Terms & Conditions

**Primary Objectives:**
1. Establish credibility with investors and partners
2. Communicate the AI-centric business methodology
3. Provide professional contact pathway
4. Meet compliance requirements for API applications (Privacy Policy, T&Cs)

---

## Technical Stack

### Recommended Stack (Modern, Performant, Maintainable)

```
Framework:       Next.js 14+ (App Router)
Language:        TypeScript
Styling:         Tailwind CSS
Animations:      Framer Motion
Icons:           Lucide React
Fonts:           Google Fonts (Inter or similar)
Forms:           React Hook Form + Zod validation
Email:           Resend API or Nodemailer
Deployment:      Vercel (recommended) or VPS
```

### Alternative Stack (Simpler, Traditional)

```
Framework:       Astro 4+
Language:        TypeScript
Styling:         Tailwind CSS
Animations:      CSS transitions + minimal JS
Deployment:      Any static host or VPS
```

### Alternative Stack (Laravel - Consistent with existing projects)

```
Framework:       Laravel 11+
Language:        PHP 8.2+ / Blade templates
Styling:         Tailwind CSS
JS:              Alpine.js for interactivity
Deployment:      VPS with Plesk (consistent with Figurs infrastructure)
```

**Decision:** Use Next.js unless the user specifies Laravel for consistency with existing infrastructure.

---

## Project Initialisation

### Next.js Setup

```bash
# Create new Next.js project
npx create-next-app@latest ascend-ai-website --typescript --tailwind --eslint --app --src-dir --import-alias "@/*"

# Navigate to project
cd ascend-ai-website

# Install additional dependencies
npm install framer-motion lucide-react react-hook-form @hookform/resolvers zod

# Install development dependencies
npm install -D @types/node

# Optional: Email functionality
npm install resend
```

### Laravel Setup (If Chosen)

```bash
# Create new Laravel project
composer create-project laravel/laravel ascend-ai-website

# Navigate to project
cd ascend-ai-website

# Install Node dependencies
npm install

# Install Tailwind CSS
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# Install Alpine.js
npm install alpinejs
```

---

## File Structure

### Next.js Structure

```
ascend-ai-website/
├── public/
│   ├── images/
│   │   ├── logo.svg
│   │   ├── logo-white.svg
│   │   ├── og-image.jpg (1200x630)
│   │   └── favicon.ico
│   └── fonts/ (if self-hosting)
│
├── src/
│   ├── app/
│   │   ├── layout.tsx (root layout)
│   │   ├── page.tsx (home)
│   │   ├── globals.css
│   │   ├── about/
│   │   │   └── page.tsx
│   │   ├── what-we-do/
│   │   │   └── page.tsx
│   │   ├── portfolio/
│   │   │   └── page.tsx
│   │   ├── work-with-us/
│   │   │   └── page.tsx
│   │   ├── contact/
│   │   │   └── page.tsx
│   │   ├── privacy-policy/
│   │   │   └── page.tsx
│   │   ├── terms-and-conditions/
│   │   │   └── page.tsx
│   │   └── api/
│   │       └── contact/
│   │           └── route.ts (contact form handler)
│   │
│   ├── components/
│   │   ├── layout/
│   │   │   ├── Header.tsx
│   │   │   ├── Footer.tsx
│   │   │   ├── Navigation.tsx
│   │   │   └── MobileMenu.tsx
│   │   ├── ui/
│   │   │   ├── Button.tsx
│   │   │   ├── Card.tsx
│   │   │   ├── Container.tsx
│   │   │   ├── SectionHeading.tsx
│   │   │   ├── Badge.tsx
│   │   │   └── Input.tsx
│   │   ├── sections/
│   │   │   ├── Hero.tsx
│   │   │   ├── ProblemStatement.tsx
│   │   │   ├── Methodology.tsx
│   │   │   ├── ProofPoints.tsx
│   │   │   ├── Opportunity.tsx
│   │   │   ├── ComparisonTable.tsx
│   │   │   └── CTASection.tsx
│   │   └── forms/
│   │       └── ContactForm.tsx
│   │
│   ├── lib/
│   │   ├── utils.ts (utility functions)
│   │   └── constants.ts (site-wide constants)
│   │
│   └── types/
│       └── index.ts (TypeScript interfaces)
│
├── tailwind.config.ts
├── next.config.js
├── tsconfig.json
├── package.json
└── README.md
```

### Laravel Structure

```
ascend-ai-website/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── PageController.php
│   │       └── ContactController.php
│   └── Mail/
│       └── ContactFormMail.php
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── components/
│   │   │   ├── header.blade.php
│   │   │   ├── footer.blade.php
│   │   │   ├── navigation.blade.php
│   │   │   ├── mobile-menu.blade.php
│   │   │   ├── button.blade.php
│   │   │   ├── card.blade.php
│   │   │   ├── section-heading.blade.php
│   │   │   └── container.blade.php
│   │   ├── sections/
│   │   │   ├── hero.blade.php
│   │   │   ├── problem-statement.blade.php
│   │   │   ├── methodology.blade.php
│   │   │   ├── proof-points.blade.php
│   │   │   ├── opportunity.blade.php
│   │   │   ├── comparison-table.blade.php
│   │   │   └── cta-section.blade.php
│   │   └── pages/
│   │       ├── home.blade.php
│   │       ├── about.blade.php
│   │       ├── what-we-do.blade.php
│   │       ├── portfolio.blade.php
│   │       ├── work-with-us.blade.php
│   │       ├── contact.blade.php
│   │       ├── privacy-policy.blade.php
│   │       └── terms-and-conditions.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
│
├── public/
│   └── images/
│
├── routes/
│   └── web.php
│
└── tailwind.config.js
```

---

## Design System

### Colour Palette

```css
/* Primary Colours */
--color-navy-950: #0a0f1c;      /* Darkest - backgrounds */
--color-navy-900: #111827;      /* Dark sections */
--color-navy-800: #1e293b;      /* Cards, elevated surfaces */
--color-navy-700: #334155;      /* Borders, dividers */

/* Accent Colours */
--color-accent-500: #0ea5e9;    /* Primary accent - sky blue */
--color-accent-400: #38bdf8;    /* Hover states */
--color-accent-300: #7dd3fc;    /* Light accent */
--color-accent-600: #0284c7;    /* Darker accent */

/* Neutral Colours */
--color-white: #ffffff;
--color-gray-50: #f8fafc;
--color-gray-100: #f1f5f9;
--color-gray-200: #e2e8f0;
--color-gray-300: #cbd5e1;
--color-gray-400: #94a3b8;
--color-gray-500: #64748b;

/* Semantic Colours */
--color-success: #10b981;
--color-error: #ef4444;
```

### Tailwind Configuration

```typescript
// tailwind.config.ts
import type { Config } from 'tailwindcss'

const config: Config = {
  content: [
    './src/pages/**/*.{js,ts,jsx,tsx,mdx}',
    './src/components/**/*.{js,ts,jsx,tsx,mdx}',
    './src/app/**/*.{js,ts,jsx,tsx,mdx}',
  ],
  theme: {
    extend: {
      colors: {
        navy: {
          700: '#334155',
          800: '#1e293b',
          900: '#111827',
          950: '#0a0f1c',
        },
        accent: {
          300: '#7dd3fc',
          400: '#38bdf8',
          500: '#0ea5e9',
          600: '#0284c7',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        display: ['Inter', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'display-xl': ['4.5rem', { lineHeight: '1.1', letterSpacing: '-0.02em' }],
        'display-lg': ['3.75rem', { lineHeight: '1.1', letterSpacing: '-0.02em' }],
        'display-md': ['3rem', { lineHeight: '1.2', letterSpacing: '-0.02em' }],
        'display-sm': ['2.25rem', { lineHeight: '1.25', letterSpacing: '-0.01em' }],
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-out',
        'fade-in-up': 'fadeInUp 0.6s ease-out',
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        fadeInUp: {
          '0%': { opacity: '0', transform: 'translateY(20px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
    },
  },
  plugins: [],
}

export default config
```

### Typography Scale

```
/* Headings */
h1 / .text-display-xl    - 72px / 4.5rem   (Hero headlines)
h2 / .text-display-lg    - 60px / 3.75rem  (Section headlines)
h3 / .text-display-md    - 48px / 3rem     (Sub-section headlines)
h4 / .text-display-sm    - 36px / 2.25rem  (Card headlines)
h5 / .text-2xl           - 24px / 1.5rem   (Small headlines)
h6 / .text-xl            - 20px / 1.25rem  (Labels)

/* Body */
.text-lg                 - 18px / 1.125rem (Lead paragraphs)
.text-base               - 16px / 1rem     (Body copy)
.text-sm                 - 14px / 0.875rem (Secondary text)
.text-xs                 - 12px / 0.75rem  (Captions, legal)
```

### Spacing System

```
/* Use Tailwind's default spacing scale */
/* Key values: */
4   = 1rem   = 16px  (base unit)
6   = 1.5rem = 24px  (small gaps)
8   = 2rem   = 32px  (medium gaps)
12  = 3rem   = 48px  (section padding mobile)
16  = 4rem   = 64px  (section padding tablet)
20  = 5rem   = 80px  (section padding desktop)
24  = 6rem   = 96px  (large section padding)
32  = 8rem   = 128px (hero padding)
```

---

## Component Specifications

### 1. Container Component

```tsx
// src/components/ui/Container.tsx
interface ContainerProps {
  children: React.ReactNode
  className?: string
  size?: 'default' | 'narrow' | 'wide'
}

// Specifications:
// - default: max-w-6xl (1152px)
// - narrow: max-w-4xl (896px) - for text-heavy pages
// - wide: max-w-7xl (1280px) - for feature sections
// - Horizontal padding: px-4 sm:px-6 lg:px-8
// - Centered: mx-auto
```

### 2. Button Component

```tsx
// src/components/ui/Button.tsx
interface ButtonProps {
  children: React.ReactNode
  variant?: 'primary' | 'secondary' | 'ghost' | 'outline'
  size?: 'sm' | 'md' | 'lg'
  href?: string
  onClick?: () => void
  disabled?: boolean
  className?: string
  icon?: React.ReactNode
  iconPosition?: 'left' | 'right'
}

// Specifications:
// Primary: bg-accent-500 text-white hover:bg-accent-400
// Secondary: bg-navy-800 text-white hover:bg-navy-700
// Ghost: bg-transparent text-white hover:bg-white/10
// Outline: border border-accent-500 text-accent-500 hover:bg-accent-500 hover:text-white

// Sizes:
// sm: px-4 py-2 text-sm
// md: px-6 py-3 text-base
// lg: px-8 py-4 text-lg

// All buttons:
// - rounded-lg
// - font-medium
// - transition-all duration-200
// - focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 focus:ring-offset-navy-950
```

### 3. Card Component

```tsx
// src/components/ui/Card.tsx
interface CardProps {
  children: React.ReactNode
  className?: string
  variant?: 'default' | 'elevated' | 'bordered' | 'glass'
  hover?: boolean
  padding?: 'sm' | 'md' | 'lg'
}

// Specifications:
// default: bg-navy-800
// elevated: bg-navy-800 shadow-xl shadow-black/20
// bordered: bg-transparent border border-navy-700
// glass: bg-white/5 backdrop-blur-sm border border-white/10

// Hover effect (when hover=true):
// - transform hover:-translate-y-1
// - transition-all duration-300

// Padding:
// sm: p-4
// md: p-6
// lg: p-8

// All cards:
// - rounded-xl
```

### 4. Section Heading Component

```tsx
// src/components/ui/SectionHeading.tsx
interface SectionHeadingProps {
  title: string
  subtitle?: string
  alignment?: 'left' | 'center'
  theme?: 'light' | 'dark'
}

// Specifications:
// Title: text-display-md or text-display-lg font-bold
// Subtitle: text-lg text-gray-400 mt-4 max-w-2xl
// Center alignment: text-center mx-auto
// Margin bottom: mb-12 or mb-16
```

### 5. Header/Navigation Component

```tsx
// src/components/layout/Header.tsx

// Specifications:
// - Fixed position: fixed top-0 left-0 right-0 z-50
// - Background: bg-navy-950/80 backdrop-blur-md
// - Border bottom: border-b border-white/10
// - Height: h-16 (mobile) h-20 (desktop)
// - Logo on left, navigation center or right, CTA button far right
// - Mobile: hamburger menu triggering slide-out or overlay menu
// - Scroll behaviour: Optional - add shadow on scroll

// Navigation items:
const navItems = [
  { label: 'Home', href: '/' },
  { label: 'About', href: '/about' },
  { label: 'What We Do', href: '/what-we-do' },
  { label: 'Portfolio', href: '/portfolio' },
  { label: 'Work With Us', href: '/work-with-us' },
  { label: 'Contact', href: '/contact' }, // styled as button
]

// Active state: text-accent-500 or underline
// Hover state: text-white transition-colors
// Default state: text-gray-300
```

### 6. Footer Component

```tsx
// src/components/layout/Footer.tsx

// Specifications:
// - Background: bg-navy-950 border-t border-navy-800
// - Padding: py-12 lg:py-16

// Layout (3-4 columns on desktop, stacked on mobile):
// Column 1: Logo + brief tagline
// Column 2: Navigation links
// Column 3: Legal links (Privacy, Terms)
// Column 4: Contact email

// Bottom bar:
// - Copyright: © 2025 Ascend AI. All rights reserved.
// - Separated by border-t border-navy-800 mt-8 pt-8

// Link styling: text-gray-400 hover:text-white transition-colors
```

### 7. Contact Form Component

```tsx
// src/components/forms/ContactForm.tsx

// Fields:
// 1. Name (required) - text input
// 2. Email (required) - email input with validation
// 3. Organisation (optional) - text input
// 4. Nature of Enquiry (required) - select dropdown
//    Options: Investment, Partnership, Advisory, General Enquiry
// 5. Message (required) - textarea, min 50 characters

// Validation:
// - Use Zod schema for validation
// - Show inline errors below each field
// - Disable submit button until form is valid

// Submit behaviour:
// - Show loading state on button
// - POST to /api/contact
// - Show success message on completion
// - Show error message if failed
// - Clear form on success

// Styling:
// - Inputs: bg-navy-800 border border-navy-700 rounded-lg px-4 py-3
// - Focus: border-accent-500 ring-1 ring-accent-500
// - Error: border-red-500
// - Labels: text-sm font-medium text-gray-300 mb-2
```

**Zod Schema:**

```typescript
import { z } from 'zod'

export const contactFormSchema = z.object({
  name: z.string().min(2, 'Name must be at least 2 characters'),
  email: z.string().email('Please enter a valid email address'),
  organisation: z.string().optional(),
  enquiryType: z.enum(['investment', 'partnership', 'advisory', 'general'], {
    required_error: 'Please select an enquiry type',
  }),
  message: z
    .string()
    .min(50, 'Message must be at least 50 characters')
    .max(5000, 'Message must be less than 5000 characters'),
})

export type ContactFormData = z.infer<typeof contactFormSchema>
```

---

## Page-by-Page Implementation

### Page 1: Home (Landing Page)

**Route:** `/` (`src/app/page.tsx`)

**Sections (in order):**

#### 1.1 Hero Section
- Full viewport height: `min-h-screen`
- Background: Gradient from navy-950 to navy-900, optional subtle animated mesh/grid
- Content centred vertically and horizontally
- Headline: Large, bold, `max-w-4xl`
- Subheadline: `text-xl text-gray-300`, `max-w-2xl`
- Two CTA buttons side by side
- Optional: Subtle scroll indicator at bottom

```tsx
// Hero content from CONTENT_BLUEPRINT.md:
// Headline: "The Companies That Make Traditional Business Obsolete"
// Subheadline: "Ascend AI builds software companies from the ground up..."
// CTA 1: "Learn How We Do It" (scrolls to methodology)
// CTA 2: "Get In Touch" (links to /contact)
```

#### 1.2 Problem Statement Section
- Background: `bg-navy-900`
- Padding: `py-20 lg:py-32`
- Section heading centred
- Three-column grid (stacks on mobile) with icon + text cards
- Transition statement below in larger text

```tsx
// Section heading: "Traditional Software Companies Are Economically Broken"
// Three columns:
// 1. Development - "Months of coding. Hundreds of thousands in developer costs..."
// 2. Operations - "Support teams. Server administrators. Account managers..."
// 3. Limitations - "9-to-5 availability. Holiday cover. Sick leave..."
// Transition: "What if you could eliminate all of it?"
```

#### 1.3 Methodology Section
- Background: `bg-navy-950`
- Four feature cards in 2x2 grid (single column mobile)
- Each card: Icon, headline, description
- Cards use 'glass' or 'bordered' variant

```tsx
// Section heading: "Built Around AI From Day One"
// Four cards:
// 1. AI-Accelerated Development
// 2. Autonomous Operations
// 3. Infinite Scalability
// 4. Unassailable Margins
```

#### 1.4 Proof Points Section
- Background: `bg-navy-900`
- Brief intro text
- Optional: Animated counter stats
- Quote or statement about portfolio

```tsx
// Heading: "Proven. Replicable. Scalable."
// Content about portfolio companies
```

#### 1.5 Opportunity Section
- Background: gradient or `bg-navy-950`
- Two-column layout: text left, visual/graphic right
- Investor-focused messaging

```tsx
// Heading: "Every Legacy Market Is Vulnerable"
// Investor-focused copy
```

#### 1.6 CTA Section
- Background: Accent gradient or `bg-navy-800` with accent border
- Centred content
- Strong headline
- Two pathway buttons or single Contact button

```tsx
// Heading: "Interested in the Future of Business?"
// Two paths: Investors / Collaborators
// CTA: "Contact Us"
```

---

### Page 2: About Us

**Route:** `/about` (`src/app/about/page.tsx`)

**Sections:**

#### 2.1 Hero Section
- Shorter than home hero: `py-24 lg:py-32`
- Headline + subheadline only

```tsx
// Headline: "Why Ascend AI Exists"
// Subheadline: "The economics of business have changed. We're building the companies that prove it."
```

#### 2.2 The Thesis Section
- Narrow container (`max-w-3xl`)
- Long-form prose content
- Pull quote styling for key statements
- Multiple paragraphs with good spacing (`space-y-6`)

```tsx
// Content: Full manifesto-style copy from CONTENT_BLUEPRINT.md
// "For decades, the cost of building and running a software company..."
```

#### 2.3 Philosophy/Principles Section
- Full-width background change
- Cards or list of principles
- Icon + headline + description for each
- 2-3 column grid

```tsx
// Heading: "Principles That Define Us"
// Five principles:
// 1. AI-Native, Not AI-Adapted
// 2. Speed as Strategy
// 3. Margin Is the Moat
// 4. Scale Without Constraint
// 5. Continuous Evolution
```

#### 2.4 Leadership Section
- Minimal - single card or simple text block
- Optional founder image
- Brief bio focused on philosophy

```tsx
// Heading: "The Team"
// Minimal content about lean operation
```

#### 2.5 CTA Section
- Link to What We Do page

---

### Page 3: What We Do

**Route:** `/what-we-do` (`src/app/what-we-do/page.tsx`)

**Sections:**

#### 3.1 Hero Section
```tsx
// Headline: "Building the Uncompetable"
// Subheadline: "From market identification to autonomous operation..."
```

#### 3.2 Process/Methodology Section
- Vertical timeline or stepped cards
- 5 steps with number, headline, description
- Icons for each step
- Optional connecting line between steps

```tsx
// Steps:
// 1. Market Identification
// 2. AI-First Architecture
// 3. Rapid Development
// 4. Autonomous Operations
// 5. Customer-Driven Evolution
```

#### 3.3 Economics Comparison Section
- Styled comparison table
- `bg-navy-800` rows, accent highlights for Ascend AI column
- Responsive: horizontal scroll on mobile or card-based alternative

```tsx
// Table comparing:
// - Development Timeline
// - Development Cost
// - Support Staff
// - Operational Overhead
// - Gross Margin
// - Scaling Model
```

#### 3.4 What We Build Section
- Criteria list with checkmark icons
- Grid or simple list layout

```tsx
// Heading: "Our Focus"
// Criteria:
// - Recurring revenue models
// - Definable, automatable workflows
// - Markets with legacy incumbents
// - Compliance or data-driven verticals
// - Global or scalable addressable markets
```

#### 3.5 Partnership Options Section
- Three cards side by side
- Investment / Joint Ventures / Advisory
- Each with headline, description, CTA link

---

### Page 4: Portfolio (Case Studies)

**Route:** `/portfolio` (`src/app/portfolio/page.tsx`)

**Sections:**

#### 4.1 Hero Section
```tsx
// Headline: "Proof of Concept. Proof of Model."
// Subheadline: "Our portfolio companies demonstrate the Ascend AI methodology in action..."
```

#### 4.2 Coming Soon Notice
- Prominent but not alarming
- Badge or banner styling

```tsx
// Message explaining case studies will be added post-launch
```

#### 4.3 Portfolio Preview Section
- Three teaser cards
- Greyed out or subtle styling to indicate "coming soon"

```tsx
// Cards:
// 1. Financial Technology - UK accounting platform
// 2. Genetic Analysis - Consumer genetic profiling
// 3. Business Intelligence - Professional genetic profiling
```

#### 4.4 CTA Section
- Encourage contact for early information

---

### Page 5: Work With Us

**Route:** `/work-with-us` (`src/app/work-with-us/page.tsx`)

**Sections:**

#### 5.1 Hero Section
```tsx
// Headline: "Build the Future With Us"
// Subheadline: "Whether you're an investor, a potential partner..."
```

#### 5.2 For Investors Section
- Card or distinct section with headline, description, CTA

#### 5.3 For Partners Section
- Similar layout, different content

#### 5.4 For Organisations Section
- Advisory/consultancy offering

#### 5.5 General Enquiries Section
- Catch-all with link to contact

---

### Page 6: Contact

**Route:** `/contact` (`src/app/contact/page.tsx`)

**Sections:**

#### 6.1 Hero Section
- Shorter, minimal

```tsx
// Headline: "Get In Touch"
// Subheadline: "Interested in Ascend AI, our portfolio, or partnership opportunities?"
```

#### 6.2 Contact Information
- Email address (clickable `mailto:`)
- Optional: Registered address

#### 6.3 Contact Form
- Full ContactForm component
- Two-column layout on desktop: form left, info right
- Or single column centred

#### 6.4 Response Expectation
- Small text: "We review all enquiries personally and aim to respond within 48 hours."

---

### Page 7: Privacy Policy

**Route:** `/privacy-policy` (`src/app/privacy-policy/page.tsx`)

**Layout:**
- Narrow container (`max-w-3xl`)
- Legal document styling
- Clear hierarchy with numbered sections
- Last updated date at top

**Sections to include:**
1. Introduction
2. Information We Collect
3. How We Use Your Information
4. Legal Basis for Processing (GDPR)
5. Data Sharing
6. Data Retention
7. Your Rights
8. Cookies
9. Security
10. International Transfers
11. Changes to Policy
12. Contact

---

### Page 8: Terms & Conditions

**Route:** `/terms-and-conditions` (`src/app/terms-and-conditions/page.tsx`)

**Layout:**
- Same as Privacy Policy
- Numbered sections
- Definition list for key terms

**Sections to include:**
1. Introduction
2. Definitions
3. Services
4. Intellectual Property
5. User Obligations
6. Consultancy & Advisory Services
7. Confidentiality
8. Limitation of Liability
9. Disclaimers
10. Termination
11. Governing Law & Jurisdiction
12. Dispute Resolution
13. General Provisions
14. Contact

---

## API Endpoint Specification

### Contact Form Handler

**Route:** `/api/contact/route.ts`

**Method:** POST

**Request Body:**
```typescript
interface ContactFormData {
  name: string
  email: string
  organisation?: string
  enquiryType: 'investment' | 'partnership' | 'advisory' | 'general'
  message: string
}
```

**Implementation:**

```typescript
// src/app/api/contact/route.ts
import { NextResponse } from 'next/server'
import { Resend } from 'resend'
import { contactFormSchema } from '@/lib/schemas'

const resend = new Resend(process.env.RESEND_API_KEY)

export async function POST(request: Request) {
  try {
    const body = await request.json()
    
    // Validate input
    const result = contactFormSchema.safeParse(body)
    if (!result.success) {
      return NextResponse.json(
        { success: false, message: 'Validation failed', errors: result.error.flatten() },
        { status: 400 }
      )
    }
    
    const { name, email, organisation, enquiryType, message } = result.data
    
    // Send email
    await resend.emails.send({
      from: process.env.CONTACT_EMAIL_FROM!,
      to: process.env.CONTACT_EMAIL_TO!,
      subject: `New Ascend AI Enquiry: ${enquiryType} from ${name}`,
      html: `
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Organisation:</strong> ${organisation || 'Not provided'}</p>
        <p><strong>Enquiry Type:</strong> ${enquiryType}</p>
        <p><strong>Message:</strong></p>
        <p>${message.replace(/\n/g, '<br>')}</p>
      `,
    })
    
    return NextResponse.json({
      success: true,
      message: 'Thank you for your enquiry. We will respond within 48 hours.',
    })
  } catch (error) {
    console.error('Contact form error:', error)
    return NextResponse.json(
      { success: false, message: 'Failed to send message. Please try again or email us directly.' },
      { status: 500 }
    )
  }
}
```

---

## Animation Specifications

### Page Load Animations (Framer Motion)

```typescript
// src/lib/animations.ts

// Container with staggered children
export const containerVariants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: {
      staggerChildren: 0.1,
      delayChildren: 0.2,
    },
  },
}

// Individual items
export const itemVariants = {
  hidden: { opacity: 0, y: 20 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { duration: 0.5, ease: 'easeOut' },
  },
}

// Hero text animation
export const heroVariants = {
  hidden: { opacity: 0, y: 30 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { duration: 0.8, ease: [0.25, 0.1, 0.25, 1] },
  },
}

// Fade in from left
export const fadeInLeft = {
  hidden: { opacity: 0, x: -30 },
  visible: {
    opacity: 1,
    x: 0,
    transition: { duration: 0.6, ease: 'easeOut' },
  },
}

// Fade in from right
export const fadeInRight = {
  hidden: { opacity: 0, x: 30 },
  visible: {
    opacity: 1,
    x: 0,
    transition: { duration: 0.6, ease: 'easeOut' },
  },
}
```

### Scroll Animations

```tsx
// Usage in components
import { motion } from 'framer-motion'
import { containerVariants, itemVariants } from '@/lib/animations'

<motion.div
  initial="hidden"
  whileInView="visible"
  viewport={{ once: true, margin: "-100px" }}
  variants={containerVariants}
>
  <motion.div variants={itemVariants}>
    {/* Content */}
  </motion.div>
</motion.div>
```

### CSS Transitions

```css
/* Add to globals.css */

/* Card hover */
.card-hover {
  @apply transition-all duration-300;
}
.card-hover:hover {
  @apply -translate-y-1 shadow-xl shadow-accent-500/10;
}

/* Button hover */
.btn-hover {
  @apply transition-all duration-200;
}
.btn-hover:hover {
  @apply -translate-y-0.5 shadow-lg;
}

/* Link hover */
.link-hover {
  @apply transition-colors duration-200;
}
```

### Background Animation (Optional Hero)

```css
/* Animated gradient background */
@keyframes gradient-shift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

.animated-gradient {
  background: linear-gradient(-45deg, #0a0f1c, #111827, #0a0f1c, #1e293b);
  background-size: 400% 400%;
  animation: gradient-shift 15s ease infinite;
}
```

---

## SEO & Meta Configuration

### Root Layout

```tsx
// src/app/layout.tsx
import type { Metadata } from 'next'
import { Inter } from 'next/font/google'
import './globals.css'
import { Header } from '@/components/layout/Header'
import { Footer } from '@/components/layout/Footer'

const inter = Inter({ subsets: ['latin'] })

export const metadata: Metadata = {
  metadataBase: new URL('https://ascend-ai.co.uk'),
  title: {
    default: 'Ascend AI | Building the Companies That Make Traditional Business Obsolete',
    template: '%s | Ascend AI',
  },
  description: 'Ascend AI builds SaaS companies from the ground up around artificial intelligence. Unbeatable economics. Infinite scalability. Margins that legacy competitors cannot match.',
  keywords: ['AI', 'SaaS', 'venture studio', 'artificial intelligence', 'automation', 'software development', 'UK'],
  authors: [{ name: 'Ascend AI' }],
  creator: 'Ascend AI',
  publisher: 'Ascend AI',
  robots: {
    index: true,
    follow: true,
  },
  openGraph: {
    type: 'website',
    locale: 'en_GB',
    url: 'https://ascend-ai.co.uk',
    siteName: 'Ascend AI',
    title: 'Ascend AI | Building the Companies That Make Traditional Business Obsolete',
    description: 'Ascend AI builds SaaS companies from the ground up around artificial intelligence.',
    images: [
      {
        url: '/images/og-image.jpg',
        width: 1200,
        height: 630,
        alt: 'Ascend AI',
      },
    ],
  },
  twitter: {
    card: 'summary_large_image',
    title: 'Ascend AI | Building the Companies That Make Traditional Business Obsolete',
    description: 'Ascend AI builds SaaS companies from the ground up around artificial intelligence.',
    images: ['/images/og-image.jpg'],
  },
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="en">
      <body className={`${inter.className} bg-navy-950 text-white antialiased`}>
        <Header />
        <main>{children}</main>
        <Footer />
      </body>
    </html>
  )
}
```

### Per-Page Meta Examples

```tsx
// src/app/about/page.tsx
export const metadata: Metadata = {
  title: 'About Us',
  description: 'Learn about Ascend AI\'s philosophy and methodology for building AI-centric businesses that traditional companies cannot compete with.',
}

// src/app/what-we-do/page.tsx
export const metadata: Metadata = {
  title: 'What We Do',
  description: 'Discover how Ascend AI builds SaaS companies with AI at their core—from market identification to autonomous operation.',
}

// src/app/portfolio/page.tsx
export const metadata: Metadata = {
  title: 'Portfolio',
  description: 'Explore Ascend AI\'s portfolio of AI-centric companies disrupting legacy markets across finance, genetics, and business intelligence.',
}

// src/app/work-with-us/page.tsx
export const metadata: Metadata = {
  title: 'Work With Us',
  description: 'Partner with Ascend AI. Investment opportunities, joint ventures, and advisory services for building AI-centric businesses.',
}

// src/app/contact/page.tsx
export const metadata: Metadata = {
  title: 'Contact',
  description: 'Get in touch with Ascend AI. We respond to all enquiries within 48 hours.',
}

// src/app/privacy-policy/page.tsx
export const metadata: Metadata = {
  title: 'Privacy Policy',
  description: 'Ascend AI privacy policy. How we collect, use, and protect your personal information.',
}

// src/app/terms-and-conditions/page.tsx
export const metadata: Metadata = {
  title: 'Terms & Conditions',
  description: 'Ascend AI terms and conditions of service.',
}
```

### Structured Data

```tsx
// Add to src/app/layout.tsx or src/app/page.tsx

const structuredData = {
  '@context': 'https://schema.org',
  '@type': 'Organization',
  name: 'Ascend AI',
  url: 'https://ascend-ai.co.uk',
  logo: 'https://ascend-ai.co.uk/images/logo.svg',
  description: 'Venture studio building AI-centric SaaS companies',
  foundingDate: '2025',
  contactPoint: {
    '@type': 'ContactPoint',
    email: 'contact@ascend-ai.co.uk',
    contactType: 'business enquiries',
  },
  sameAs: [
    // Add social media URLs when available
  ],
}

// In the component:
<script
  type="application/ld+json"
  dangerouslySetInnerHTML={{ __html: JSON.stringify(structuredData) }}
/>
```

---

## Responsive Breakpoints

```
/* Tailwind defaults */
sm: 640px   /* Mobile landscape */
md: 768px   /* Tablet */
lg: 1024px  /* Desktop */
xl: 1280px  /* Large desktop */
2xl: 1536px /* Extra large */

/* Common patterns */
/* Grid: grid-cols-1 md:grid-cols-2 lg:grid-cols-3 */
/* Padding: px-4 sm:px-6 lg:px-8 */
/* Section padding: py-16 lg:py-24 */
/* Font sizes: text-3xl md:text-4xl lg:text-5xl */
/* Hiding elements: hidden lg:block or lg:hidden */
```

---

## Performance Requirements

### Target Scores

| Metric | Target |
|--------|--------|
| Lighthouse Performance | >90 |
| Lighthouse Accessibility | >95 |
| Lighthouse Best Practices | >95 |
| Lighthouse SEO | >95 |
| LCP | <2.5s |
| FID | <100ms |
| CLS | <0.1 |

### Optimisations to Implement

1. **Images**
   - Use Next.js Image component
   - Serve WebP format
   - Implement lazy loading
   - Define explicit dimensions

2. **Fonts**
   - Use next/font for optimised loading
   - Preload critical fonts
   - Use font-display: swap

3. **JavaScript**
   - Minimise client-side JavaScript
   - Use dynamic imports for non-critical components
   - Implement code splitting

4. **CSS**
   - Tailwind CSS purging enabled by default
   - Remove unused styles

---

## Environment Variables

```env
# .env.local

# Site Configuration
NEXT_PUBLIC_SITE_URL=https://ascend-ai.co.uk
NEXT_PUBLIC_SITE_NAME=Ascend AI

# Contact Form
CONTACT_EMAIL_TO=contact@ascend-ai.co.uk
CONTACT_EMAIL_FROM=noreply@ascend-ai.co.uk

# Email Service (Resend)
RESEND_API_KEY=re_xxxxxxxxxxxx

# Alternative: SMTP Configuration
# SMTP_HOST=smtp.example.com
# SMTP_PORT=587
# SMTP_USER=
# SMTP_PASSWORD=

# Analytics (optional)
# NEXT_PUBLIC_GA_ID=G-XXXXXXXXXX
```

---

## Deployment Configuration

### Vercel (Recommended)

```json
// vercel.json
{
  "buildCommand": "npm run build",
  "outputDirectory": ".next",
  "framework": "nextjs",
  "regions": ["lhr1"],
  "headers": [
    {
      "source": "/(.*)",
      "headers": [
        {
          "key": "X-Content-Type-Options",
          "value": "nosniff"
        },
        {
          "key": "X-Frame-Options",
          "value": "DENY"
        },
        {
          "key": "X-XSS-Protection",
          "value": "1; mode=block"
        },
        {
          "key": "Referrer-Policy",
          "value": "strict-origin-when-cross-origin"
        }
      ]
    }
  ]
}
```

### VPS with Nginx (Alternative)

```nginx
# /etc/nginx/sites-available/ascend-ai.co.uk

server {
    listen 80;
    server_name ascend-ai.co.uk www.ascend-ai.co.uk;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name ascend-ai.co.uk www.ascend-ai.co.uk;
    
    ssl_certificate /etc/letsencrypt/live/ascend-ai.co.uk/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/ascend-ai.co.uk/privkey.pem;
    
    # Security headers
    add_header X-Content-Type-Options nosniff;
    add_header X-Frame-Options DENY;
    add_header X-XSS-Protection "1; mode=block";
    
    location / {
        proxy_pass http://localhost:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}
```

---

## Logo Requirements

### If No Logo Exists

Create a simple text-based logo with the following specifications:

**Primary Logo:**
- Text: "ASCEND AI" or "Ascend AI"
- Font: Inter Bold or similar geometric sans-serif
- The "A" in Ascend could incorporate an upward arrow motif (↗)
- Colour: White (for dark backgrounds) or Navy-950 (for light)

**Icon/Favicon:**
- Simplified "A" with arrow motif
- Works at 32x32 and 16x16
- Colour: Accent-500 (#0ea5e9) or White

**Required Files:**
- `logo.svg` - Primary logo (horizontal)
- `logo-white.svg` - White version for dark backgrounds
- `favicon.ico` - 16x16 and 32x32 favicon
- `apple-touch-icon.png` - 180x180 for iOS
- `og-image.jpg` - 1200x630 for social sharing

---

## Testing Checklist

### Functionality
- [ ] All pages render correctly
- [ ] Navigation works on all pages
- [ ] Mobile menu opens/closes correctly
- [ ] All links point to correct destinations
- [ ] Contact form validates correctly
- [ ] Contact form submits successfully
- [ ] Email is received with correct content
- [ ] Success/error states display correctly

### Content
- [ ] All images load and have alt text
- [ ] No placeholder text remaining
- [ ] Privacy Policy content is complete
- [ ] Terms & Conditions content is complete

### SEO
- [ ] Meta tags present on all pages
- [ ] OG image displays correctly when shared
- [ ] Favicon displays in browser tab
- [ ] Structured data validates

### Cross-Browser
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge
- [ ] iOS Safari
- [ ] Android Chrome

### Performance
- [ ] Lighthouse scores meet targets
- [ ] Images optimised
- [ ] No render-blocking resources

### Security
- [ ] SSL certificate is valid
- [ ] Security headers configured
- [ ] Form inputs sanitised

### Accessibility
- [ ] Keyboard navigation works
- [ ] Focus states visible
- [ ] Colour contrast meets WCAG AA
- [ ] Screen reader compatible

### Other
- [ ] 404 page exists and is styled
- [ ] www redirects to non-www (or vice versa)
- [ ] Trailing slashes handled consistently

---

## Final Notes for AI Code Assistant

1. **Reference the content blueprint** (`ASCEND_AI_CONTENT_BLUEPRINT.md`) for all copy, headlines, and messaging. Do not invent content.

2. **Prioritise clarity over cleverness** in code. This site should be maintainable.

3. **Mobile-first approach** throughout. Test at 375px width minimum.

4. **Accessibility matters.** Ensure proper heading hierarchy, alt text, focus states, and colour contrast (WCAG AA minimum).

5. **Keep dependencies minimal.** Only install what's necessary.

6. **Comment complex logic** but don't over-comment obvious code.

7. **Use TypeScript strictly.** No `any` types unless absolutely necessary.

8. **Follow the file structure** specified in this document.

9. **Test thoroughly** before considering any page complete.

10. **If in doubt, ask.** Ambiguity should be clarified before implementation.

---

## Quick Reference: Key URLs

| Item | URL |
|------|-----|
| Production Site | https://ascend-ai.co.uk |
| Home | / |
| About | /about |
| What We Do | /what-we-do |
| Portfolio | /portfolio |
| Work With Us | /work-with-us |
| Contact | /contact |
| Privacy Policy | /privacy-policy |
| Terms & Conditions | /terms-and-conditions |
| Contact API | /api/contact |

---

**End of Technical Specification**

*Document Version: 1.0*
*Last Updated: January 2025*
*Domain: ascend-ai.co.uk*
