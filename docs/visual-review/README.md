# Ascend AI: visual review and comparison mockups

Reviewed 1 October 2026. Open `index.html` in a browser, or run `python -m http.server 4173 --bind 127.0.0.1 --directory docs/visual-review` from the project root and visit http://127.0.0.1:4173/.

## Design brief

Keep Ascend AI's dark navy identity, cyan accent, plain language and focus on small building firms and trades of 1 to 25 people. Make the first screen easier to understand, give the existing photography a clearer role, and make the examples easier to find.

The two proposed pages are **Home** and **Solutions**. Home tests the overall visual direction; Solutions tests whether the same system works for detailed service information. They use existing project images and clearly labelled illustrative examples. Shortened copy is proposed for these mockups only.

## Implementation boundary

- Standalone HTML, CSS and JavaScript in this folder, with local copies of selected existing images.
- Existing Laravel routes, Blade templates, approved content blueprint and built production assets are untouched.
- No database, application API, new package, form submission or deployment is needed.
- Audit buttons open the existing live enquiry page with `type=audit`. Other unmocked destinations open their live pages.
- The comparison uses captured first screens of the live website; the proposed pages are interactive and responsive.
- Interactions: mobile navigation, Home example selector, admin-cost calculator, Solutions selector with shareable hash links, FAQ disclosures, comparison page and viewport controls.
- Verification: real-browser desktop and mobile layouts, horizontal overflow, keyboard navigation, interaction state, image loading and console errors. Backend tests are outside this isolated visual prototype's scope.

## Project findings

The project uses Laravel 12, Blade, Tailwind 3, Alpine 3 and Vite 7. The public pages share the layout header, footer and hero components. Existing examples live in `resources/views/components/vignettes`; photos live in `public/images`. Production uses PostgreSQL and tests use Pest/PHPUnit with SQLite. This prototype reuses the visual assets and content ideas without introducing application dependencies.

See [REVIEW.md](REVIEW.md) for the detailed recommendations and [VALIDATION.md](VALIDATION.md) for the completed checks.
