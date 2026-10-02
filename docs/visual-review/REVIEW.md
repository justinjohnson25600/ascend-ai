# Ascend AI: visual recommendations

## My recommendation

Keep the dark navy and cyan identity, but make it quieter, more human and easier to scan. Lead with a clear business benefit, use the existing trade photography as a visible part of the story, and let visitors choose the examples that interest them.

The current site has useful content and unusually concrete demonstrations. Its presentation gives too many elements similar visual weight: circuit lines, gradient headings, large sections, glass cards, animations and repeated calls to action. The strongest improvement is deciding what deserves attention at each point on the page.

## What I reviewed

The live Home, Solutions, Who It's For, AI Agents, How It Works, About, Contact, What Is Business Automation, Automation Ideas and Your Data pages, plus the shared layout and image assets. I inspected Home and Solutions at desktop and mobile sizes and reviewed the Contact desktop layout. The remaining pages were reviewed through their live structure, content and shared components, rather than a complete visual audit of every viewport.

References: [live Home](https://ascend-ai.co.uk/), [live Solutions](https://ascend-ai.co.uk/solutions), [live Contact](https://ascend-ai.co.uk/contact?type=audit). Captures were taken on 1 October 2026 at 1440 × 1000 and 390 × 844. The comparison shows the first Home carousel slide, selected and paused before capture. The proposed pages use those same viewport sizes.

## Improvements in priority order

| Priority | Current observation | Recommended change | Why it helps |
| --- | --- | --- | --- |
| 1 | Home rotates through eight hero slides. The central promise and primary action change as the visitor reads. | Keep one fixed hero. Put selectable examples further down. | The business becomes easier to understand on first arrival; the visitor controls what they explore. |
| 1 | Home opens with a long paragraph. At 390 px wide, the primary CTA appears near the bottom of an 844 px screen. | Reduce the introduction to a few lines, give the heading a strong hierarchy and move the audit CTA up. | The offer and next step become visible sooner. |
| 1 | Circuit patterns sit behind copy across the main page heroes. | Use a quiet solid background for text and a distinct area for the visual. | Better separation between message, illustration and action; a less generic technology-agency feel. |
| 1 | The first-screen example is hidden below the desktop breakpoint. | Include a compact example on phones, with the main CTA before it. | Mobile visitors can understand the service through the same concrete evidence. |
| 2 | Useful photos are mostly dimmed behind text and cards. | Promote selected images into dedicated panels, with restrained labels and one example overlay. | The photos become recognisable settings, rather than additional background texture. |
| 2 | The desktop header has six links, an audit CTA and a separate social row. | Use a single compact header with Solutions, Who It's For, How It Works and an Explore menu. Move social links to the footer. | More room for the first screen and a clearer route to the most useful information. All five social destinations remain available. |
| 2 | Blue-to-purple headings, bright buttons, coloured numbers and glowing backgrounds compete. | Keep cyan for actions and selected emphasis, warm amber for problems and green for completed tasks. Use white for most headings. | Colour begins to communicate meaning consistently. |
| 2 | Many sections repeat the same centred heading, big gap and card grid. | Mix a large opening image, a few service cards, an example panel, a photographic section and a simple process row. | Different sections become easier to recognise and remember. |
| 2 | Solutions presents six long sections with similar structures. Its hero postpones the first concrete example. | Use a compact introduction and a six-option service explorer with problem, workflow and owner control together. | Visitors can compare the areas without working through a long repeated layout. |
| 3 | Some interface detail is small and subdued, while headings are consistently large. | Use fewer type sizes, clearer body contrast and shorter text measures. Test small labels at their real rendered size. | Reading becomes more comfortable and the hierarchy feels deliberate. |
| 3 | Demonstrations and decorative motion happen at the same time. | Let the examples change on request. Keep hover movement subtle and honour reduced-motion preferences. | Each interaction has a clear purpose and less competes for attention. |
| 3 | The page contains credibility material, but it is spread across multiple sections. | Group the specialism, existing-tools message, owner control and audit deliverable near the relevant decision. | Visitors get reassurance when they need it. Avoid invented client logos, testimonials or savings figures. |

These are design judgements. The mockups do not establish a measured conversion uplift; that would require usability feedback or a controlled comparison after implementation.

## The two mockups

### Home

- Retains the existing main headline and dark identity.
- Brings “small building firms and trades of 1 to 25 people” into the first screen.
- Uses the existing van-at-home photograph to make the benefit tangible. Its warm window light balances the cool cyan accent.
- Places the audit CTA and a secondary “See it in action” link beneath a shorter introduction.
- Shows three example admin tasks over the photo, labelled **Example**.
- Prioritises three service cards, with access to all six areas.
- Provides three visitor-controlled demonstrations: missed call, quote follow-up and receipt filing.
- Retains the practical process and the admin-cost calculator, with the assumptions visible.
- Gives the final audit invitation a distinct cyan-tinted section.

### Solutions

- Brings service selection into the first desktop screen.
- Shows the problem, the proposed work and what stays with the owner in one panel.
- Changes the example below when a different service is selected.
- Supports direct links such as `solutions.html#quotes` and `solutions.html#paperwork`.
- Keeps all six options visible on mobile and stacks the workflow steps vertically.
- Uses a workshop photo at the transition from service information to the audit invitation.
- Uses expandable questions for secondary detail.

The explorer is a useful direction to compare, but it hides unselected detail. Before a production change, check whether target customers prefer this to the current long page. Render the full service content on the server in the final Blade implementation so the design remains useful when scripts fail and available to search engines.

## Further page-specific opportunities

| Page | Next improvement |
| --- | --- |
| Who It's For | Give the building-and-trades specialism a fixed first screen. The current carousel also includes the other sectors; make those a separate, clearly secondary section. Use the existing site-office and home-on-time photographs at a useful size. |
| AI Agents | Bring “you decide how much it does” forward. A visible approval example would make the explanation more concrete than an abstract learning graphic. |
| How It Works | Combine process and charging stages into one clear sequence. Highlight exactly what the free audit produces. Keep numeric price claims out until confirmed. |
| About | A real, supplied portrait of Justin would strengthen the human connection beyond the current initials treatment. Pair it with a concise founder statement. |
| Contact | Bring the form into the opening layout, alongside a compact “what happens next” panel. In the desktop review, the large introductory hero pushes the actual form below the first screen. |
| What Is Business Automation | Use a short, obvious reading path with one small example per idea. This is a useful supporting guide; it need not dominate the main navigation. |
| Automation Ideas | Keep the dense, practical layout. Make selected filters, result count and reset controls immediately recognisable. Preserve deep-linkable examples. |
| Your Data | Give the page a calm reading layout and a simple labelled data-flow diagram. Keep explanatory text on a solid background. |

## What I would carry into production first

1. The fixed Home hero, shorter introduction and simpler header.
2. The new type, colour and spacing system, applied through shared components.
3. More visible, carefully cropped existing photography.
4. Examples that remain usable on phones.
5. The Solutions explorer, after comparing its browsing behaviour with the long page.

The mockups are standalone design artifacts. Revised copy needs to be incorporated into `CONTENT_BLUEPRINT_V2.md` before changing production Blade templates, and any final content changes should also be reflected in the website assistant's briefing. Keep the existing working enquiry and newsletter flows when implementing the visual system.

## Review limitations

- The comparison's current-site panels are screenshots, not embedded live pages. Use **Open live** for the actual site.
- The proposed pages are interactive HTML mockups. Audit buttons open the live enquiry page; the mockups do not send forms.
- Existing project photography is reused. The scenes and example interfaces are illustrative, with no claim that they depict a customer installation.
- Google Fonts supplies the two proposed typefaces; system sans-serif fallbacks are specified. A production implementation could self-host the fonts.
- This is a visual and information-hierarchy review, not a complete accessibility, SEO, legal or performance audit.
