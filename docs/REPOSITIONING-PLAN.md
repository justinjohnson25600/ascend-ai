# Repositioning Plan: from "AI venture studio" to "Business Automation Solutions"

Status: DRAFT for review. Nothing in this plan has been applied to the site.
Date: 25 September 2026

## 1. The change in one line

Today the site says: "Ascend AI builds SaaS companies from the ground up around AI." It pitches investors and partners.

The new message: "Ascend AI provides small businesses with AI automation platforms." It pitches small-business buyers.

That is not a copy edit. It changes the audience (investors to SME owners), the call to action (invest or partner to buy or book), the proof (portfolio companies to customer outcomes), the enquiry types, and the legal pages.

## 2. Where the current message lives

### Copy in Blade pages (rewrite)

| File | What it says now |
|------|------------------|
| `pages/home.blade.php` | Hero "The Companies That Make Traditional Business Obsolete"; problem section; methodology; proof counters "14 days / 99% / 0 staff / 24/7"; opportunity; CTA to investors and collaborators |
| `pages/about.blade.php` | Manifesto, five principles, team |
| `pages/what-we-do.blade.php` | Five-step venture process, economics table, focus criteria, partnership options |
| `pages/portfolio.blade.php` | Three "coming soon" ventures: FinTech (Figurs), HealthTech genetics, HR Tech |
| `pages/work-with-us.blade.php` | Investors, joint-venture partners, advisory |
| `pages/contact.blade.php` | Hero copy; enquiry types investment / partnership / advisory / general |
| `pages/privacy-policy.blade.php`, `pages/terms-and-conditions.blade.php` | Written for a venture studio. The T&Cs say investment enquiries are not offers. Both need re-drafting for a company selling services and platforms |
| `components/layout/footer.blade.php` | Tagline "Building the companies that make traditional business obsolete"; newsletter blurb; nav labels |
| `components/layout/header.blade.php` | Nav: About / What We Do / Portfolio / Work With Us / Contact |
| `components/sections/hero.blade.php`, `cta.blade.php` | Generic and reusable. Keep |

### Metadata (rewrite)

- `PageController`: every page's title and description.
- `components/layout/app.blade.php`: default description, keywords, Open Graph fallback, and the JSON-LD Organization block.
- `SitemapController`: the URL list, if slugs change.

### Data model (migration)

`contacts.enquiry_type` is a database enum of `investment | partnership | advisory | general`. The same list is repeated in `ContactEnquiryRequest`, the contact form select, and the Mailable subject. Section 4 proposes the new set.

### Assets (review)

- Videos (droid, android) and images (digi-city, droid, full-back) are "AI robot" imagery. The January brand guidance said to avoid clichéd AI aesthetics, and for an SME audience it can read as intimidating rather than helpful. Decide keep or replace.
- Logo and favicon: keep.
- Social links in header and footer point at LinkedIn, YouTube, Instagram, X and Facebook handles. Confirm they exist or remove them.

### Email

`emails/contact-form.blade.php` and the `ContactFormMail` subject reference the enquiry types.

### Things the new message needs that do not exist yet

- A description of the platforms or services on offer.
- A pricing or engagement model.
- Customer proof: case studies, testimonials, logos.
- A conversion CTA: book a call, request a demo, or a free automation audit.
- Cookie consent, if analytics are added.

## 3. Proposed site map v2

| Route | Purpose | Replaces |
|-------|---------|----------|
| `/` | Hero promise to small businesses; three pains; how it works; platforms; proof; CTA | `/` |
| `/solutions` | What we automate, by business function: lead follow-up, customer service, admin and bookkeeping, marketing content, scheduling | `/what-we-do` |
| `/platforms` | The productised platforms: name, who it is for, what it does, from-price | `/portfolio` |
| `/how-it-works` | Discovery, build, launch, support. Timelines. What the customer provides | new, or a section of `/solutions` |
| `/pricing` | Only if prices will be public. Otherwise fold into `/platforms` | new |
| `/about` | Who Ascend AI is, why small businesses, founder | `/about` |
| `/contact` | Book a call or request a demo | `/contact` |
| `/privacy-policy`, `/terms-and-conditions` | Re-drafted for a service business | same |

Old URLs get 301 redirects (`/what-we-do` to `/solutions`, `/portfolio` to `/platforms`, `/work-with-us` to `/contact`) so indexed links keep working.

Proposed nav: Solutions, Platforms, How It Works, About, and Contact as the button.

## 4. Proposed enquiry types

| Value | Label |
|-------|-------|
| `demo` | See a platform in action |
| `quote` | Get a quote for my business |
| `support` | I am an existing customer |
| `partnership` | Reseller or agency partner |
| `general` | Something else |

## 5. How we do it

0. **Positioning brief.** You answer the questions in section 6. Half a page. Nothing else starts until this is agreed, otherwise copy gets written twice.
1. **Content Blueprint v2** at `docs/CONTENT_BLUEPRINT_V2.md`. Final copy for every page in the same format as the January blueprint, including meta descriptions and enquiry types. You approve copy in the document, not in Blade.
2. **Structural code changes, no copy yet.** Routes and redirects, controller methods, the enum migration, the form request, the select, the Mailable subject, the nav. Tests updated first.
3. **Page-by-page implementation** from the blueprint, one commit per page. Home and Contact first, because they are the conversion path.
4. **Metadata.** JSON-LD (add Service and Offer entries to the Organization), sitemap, redirects verified.
5. **Legal pages** re-drafted, ideally reviewed by a solicitor before publishing.
6. **Assets.** Replace or keep the videos and images. Confirm social links.
7. **Ship.** Build assets, run the suite, deploy, then watch Search Console for 404s.

Step 1 is the long pole because it is copy. Steps 2 to 4 are one to two days of code once the copy exists.

## 6. Questions to answer before step 1

1. **Name and tagline.** Is it still "Ascend AI", with "Business Automation Solutions" as the descriptor? Is there a strapline you already use?
2. **Customer.** Which small businesses? Sector (trades, professional services, e-commerce, clinics, hospitality), size, UK only?
3. **Offer.** Named platforms you have or are building, versus bespoke automation projects. Is Figurs one of them? One line each.
4. **Commercial model.** Subscription per platform, setup fee plus monthly, project pricing, or "contact us"? Will prices be public?
5. **Primary CTA.** Book a call, request a demo, free automation audit, or start a trial?
6. **Proof.** Any customers, pilots, testimonials or numbers you are willing to publish? If none, the site leans on process and guarantees instead of metrics.
7. **Newsletter.** Keep it? If yes, double opt-in and an unsubscribe page are added before it is used.
8. **Portfolio ventures.** Do Figurs, the genetics product and the HR product appear on the new site at all, and as what?
9. **Tone.** The same confident, disruptive voice as the January blueprint, or more approachable for SME owners?
10. **Imagery.** Keep the robot and android videos, or move to a cleaner product-led look?
