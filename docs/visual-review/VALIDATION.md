# Validation

Completed 1 October 2026 against the standalone mockups.

| Check | Result |
| --- | --- |
| Home, Solutions and comparison at 320, 390, 768, 1024 and 1440 px wide | No horizontal overflow; one H1 on each page |
| Desktop Home and Solutions visual inspection | Checked opening layout, hierarchy and service/example sections |
| Mobile Home and Solutions visual inspection | Checked 390 × 844 first screens and Solutions detail panel |
| Images | Captures and hero images load; lazy-loaded Home site-office photo verified after scrolling into view |
| JavaScript | Both files pass `node --check`; no page script errors during the viewport sweep |
| Home example controls | Quote and receipt examples display the expected content and selected state |
| Calculator | 20 hours × £50 × 46 weeks displays £46,000 |
| Mobile menu | Opens, closes with Escape and restores focus to its toggle |
| Solutions | All six buttons change the heading, workflow, example and URL hash; exactly one selected state |
| Direct link | `solutions.html#quotes` opens the Quotes panel |
| FAQ | Native disclosure opens correctly |
| Comparison | Page and mobile controls update the mockup, capture, frame size and live link together |
| Motion | No automatic carousel; reduced-motion CSS disables smooth scrolling and transitions |
| Primary actions | Open the live audit enquiry page with `type=audit`; no form is submitted by the prototype |

The first image sweep ran before lazy images had entered the viewport. The site-office image was subsequently scrolled into view and confirmed loaded; it was not a missing asset.

Live captures use 1440 × 1000 desktop and 390 × 844 mobile browser viewports. The screenshot tool resizes desktop image files to 1317 × 915; the comparison displays them at the same proportional scale as the proposed viewport.

No Laravel views, routes, configuration or compiled assets were changed. No backend test run or Vite rebuild was required for these standalone files. This is targeted prototype verification, not a full accessibility audit.
