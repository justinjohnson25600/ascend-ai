# Section photo prompts

Prompts for the photos that sit behind sections of the site, at 40% opacity, like the kitchen-table photo on Home. Written 30 September 2026 for GPT-6 Astra. Placed on 30 September 2026: every scene except 1 (Home), which is still to make.

## How to use them

1. **Attach a reference.** Attach `public/images/desktop-version.webp` (or the original kitchen-table PNG) to each request, so every photo keeps the same look.
2. **Paste one prompt at a time.** Every prompt is complete and states its own size. Make both the desktop and the mobile version of each scene.
3. **Name and send.** Save each image with the file name given, and send the PNGs over. They are converted to WebP, put in `public/images`, and placed with `<x-ui.section-photo desktop="…" mobile="…" />`.

Desktop images show from 1024px wide; the mobile image covers the section on phones and tablets. So:

- **Desktop:** keep the middle of the picture calm, because the text sits in the centre.
- **Mobile:** keep the objects in the middle 60% of the width, because narrow phones crop the sides.

## Where each photo goes

Chosen from a map of every page. A photo only goes where the content is centred or light, so it shows around the edges without fighting the text. Long pages get a second photo further down.

| # | Page and section | Scene | Files |
| --- | --- | --- | --- |
| — | Home: The work that never makes it onto the invoice | Kitchen table, evening | done |
| — | AI Agents: What is an AI agent? | Kitchen table, morning | done |
| — | Contact: the form | Phone and notebook under the lamp | done |
| 1 | Home: From first call to running in the background | Van tailgate on site, early morning | `home-onsite-desktop.png`, `home-onsite-mobile.png`: **still to make** |
| 2 | What is Business Automation?: The short answer | Café just after closing | `what-cafe-desktop.png`, `what-cafe-mobile.png`: done |
| 3 | What is Business Automation?: How to tell if this is for you | The receipts drawer, late at night | `what-drawer-desktop.png`, `what-drawer-mobile.png`: done |
| 4 | Who It's For: Why we specialise | Portable site office with hard hat | `who-site-office-desktop.png`, `who-site-office-mobile.png`: done |
| 5 | Who It's For: You price the work, you approve the changes | Van on the drive, home on time | `who-home-on-time-desktop.png`, `who-home-on-time-mobile.png`: done |
| 6 | Solutions: What we don't do | Workshop bench at night | `solutions-workshop-desktop.png`, `solutions-workshop-mobile.png`: done |
| 7 | AI Agents: Questions owners ask | Van cab at lunchtime | `agents-van-desktop.png`, `agents-van-mobile.png`: done |
| 8 | How It Works: The process | Hair salon after closing | `how-salon-desktop.png`, `how-salon-mobile.png`: done |
| 9 | How It Works: What we'll need from you | Clinic reception before opening | `how-clinic-desktop.png`, `how-clinic-mobile.png`: done |
| 10 | About: Why we exist | Garage office of a business owner | `about-garage-office-desktop.png`, `about-garage-office-mobile.png`: done |
| 11 | Your data: The short version | Quiet, secure office at night | `data-office-desktop.png`, `data-office-mobile.png`: done |
| 12 | AI Agents: What is an AI agent? (phone version of the existing photo) | Kitchen table, morning, portrait | `agents-mobile.png`: done |

No photos on the Automation ideas library (a dense filtered grid), the legal pages (plain reading), or behind the animated examples, calculators, tables, forms and tabs, where a photo would fight the content.

---

## 1. Home: van tailgate on site, early morning

**Desktop, save as `home-onsite-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). Early morning on a residential building site in England. The open tailgate of a plain white work van is being used as a desk. On the left third of the frame: an open laptop on the tailgate showing a calm, mostly empty dashboard with a few soft green tick marks, and a phone beside it. On the right third: a steel flask of tea, a yellow hard hat and a folded hi-vis vest. Behind, softly out of focus, a half-built brick extension with scaffolding and a pallet of blocks, and low morning mist. Keep the central half of the frame calm, dark and empty (plain van floor and soft background), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Pale blue dawn light with one warm work lamp. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens and paper show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `home-onsite-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). Early morning on a residential building site in England, looking down at the open tailgate of a plain white work van used as a desk. A tall composition: the open laptop with a calm dashboard and soft green tick marks at the top, a yellow hard hat and a steel flask in the middle, a tape measure, a pencil and a phone near the bottom, with blurred scaffolding and morning mist beyond the top edge. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Pale blue dawn light with one warm work lamp. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens and paper show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 2. What is Business Automation?: café just after closing

**Desktop, save as `what-cafe-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). An independent British café just after closing time. On the left third of the frame: the counter with an espresso machine, a tablet on a stand glowing with a blurred order screen, and a card reader. On the right third: chairs stacked upside down on a wooden table, a blank chalkboard, a potted plant. Keep the central half of the frame calm, dark and empty (clear floorboards and a plain stretch of wall), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Warm pendant lights over the counter and blue dusk through the shop window. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens, menus and paper show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `what-cafe-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). An independent British café just after closing time, looking along the counter from one end. A tall composition: warm pendant lights and the tablet glowing with a blurred order screen at the top, coffee cups and a cake stand under a glass dome in the middle, the card reader and a roll of till receipts near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Warm pendant lights and blue dusk from the window. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens and paper show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 3. What is Business Automation?: the receipts drawer, late at night

**Desktop, save as `what-drawer-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). Late at night in a British kitchen. On the left third of the frame: a kitchen drawer pulled half open, overflowing with crumpled receipts, envelopes, elastic bands and a torch. On the right third: van keys, a calculator and a half-drunk mug of tea on the worktop. Keep the central half of the frame calm, dark and empty (a plain stretch of dark worktop and tiled wall), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. A single warm under-cabinet light and blue night through a window. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; receipts and paper show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `what-drawer-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). Late at night in a British kitchen, looking straight down into an open drawer. A tall composition: crumpled receipts and envelopes at the top, a tape measure, elastic bands and a torch in the middle, van keys and a calculator near the bottom, lit from one side by a warm lamp with the edges falling into shadow. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. One warm under-cabinet light and cool blue night. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; receipts and paper show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 4. Who It's For: portable site office with hard hat

**Desktop, save as `who-site-office-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). Inside a portable site cabin office on a British building site at dusk. On the left third of the frame: a fold-down desk with a rugged laptop and a tablet showing soft, blurred dashboards, rolled drawings held with elastic bands, and a yellow hard hat. On the right third: a hi-vis vest and ear defenders hanging on a hook, a kettle and a mug on a shelf, and a small window showing scaffolding and site lights outside. Keep the central half of the frame calm, dark and empty (a plain cabin wall), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. A warm desk lamp inside and blue dusk with orange site lights through the window. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens and drawings show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `who-site-office-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). Inside a portable site cabin office on a British building site at dusk, looking down at the desk. A tall composition: the cabin window with blue dusk and scaffolding at the top, the tablet and a yellow hard hat in the middle, rolled drawings, a phone, a pencil and a tape measure near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. A warm desk lamp and blue dusk. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens and drawings show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 5. Who It's For: van on the drive, home on time

**Desktop, save as `who-home-on-time-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). A British semi-detached house at blue hour, with a plain white work van parked on the driveway. On the left third of the frame: the van, a ladder on its roof rack and a yellow hard hat on its dashboard. On the right third: the front door and a kitchen window glowing warm, a garden gate. Keep the central half of the frame calm, dark and empty (an empty driveway and dark lawn), because centred website text will sit on top. Mood: home on time, the evening free. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Deep blue sky, the first streetlight on, warm light from the house. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names, number plates or signage anywhere. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `who-home-on-time-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). A British semi-detached house at blue hour, seen from the pavement. A tall composition: a warm upstairs window and deep blue sky at the top, the glowing kitchen window and front door in the middle, the bonnet of a plain white work van with a yellow hard hat on its dashboard near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Mood: home on time, the evening free. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Deep blue sky, a streetlight, warm light from the house. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names, number plates or signage anywhere. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 6. Solutions: workshop bench at night

**Desktop, save as `solutions-workshop-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). A small joiner's and electrician's workshop at night. On the left third of the frame: a workbench with a tablet propped against a toolbox, its screen showing a soft, blurred document layout, a pencil and a steel rule. On the right third: hand tools hung neatly on a pegboard, cable reels and a yellow hard hat on a shelf. Keep the central half of the frame calm, dark and empty (a clear stretch of bench and a plain wall), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. A warm bench lamp, blue night through a small window, a little sawdust catching the light. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens and paper show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `solutions-workshop-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). A small joiner's and electrician's workshop at night, looking down the length of the workbench from one end. A tall composition: the pegboard of tools and the glowing tablet at the top, chisels and a spirit level in the middle, a coil of cable and a tape measure near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. A warm bench lamp and blue night light. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 7. AI Agents: van cab at lunchtime

**Desktop, save as `agents-van-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). The cab of a work van parked on a quiet British street at lunchtime on a grey, drizzly day, seen from behind the seats. On the left third of the frame: a phone in a dashboard cradle glowing with a single soft notification card, and a takeaway coffee cup. On the right third: a clipboard and a yellow hard hat on the passenger seat. Keep the central half of the frame calm, dark and empty (the windscreen with soft raindrops and a blurred row of terraced houses), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Cool grey daylight with a warm glow from the phone. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names, number plates or signage anywhere; the screen shows only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `agents-van-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). The cab of a work van parked on a quiet British street on a drizzly day, looking down from above the passenger seat. A tall composition: the rain-speckled windscreen and the phone glowing in its dashboard cradle at the top, the clipboard and a yellow hard hat on the seat in the middle, a takeaway coffee in the cup holder near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Cool daylight with a warm glow from the phone. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; the screen shows only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 8. How It Works: hair salon after closing

**Desktop, save as `how-salon-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). A small independent hair salon on a British high street, just after closing. On the left third of the frame: the reception desk with a tablet showing a soft, blurred appointment calendar, a card reader and a small vase of flowers. On the right third: two styling chairs facing mirrors framed with warm bulbs, and neatly arranged brushes and unlabelled bottles. Keep the central half of the frame calm, dark and empty (a clear stretch of polished floor and plain wall), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Warm mirror lights and blue dusk through the shop window. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; the screen shows only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `how-salon-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). A small independent hair salon just after closing, looking along the reception desk towards the styling area. A tall composition: glowing mirror lights at the top, the tablet with a blurred appointment calendar and a vase of flowers in the middle, the card reader and a small stack of appointment cards near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Warm mirror lights and blue dusk. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens and cards show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 9. How It Works: clinic reception before opening

**Desktop, save as `how-clinic-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). The reception of a small physiotherapy clinic in England, early morning before opening. On the left third of the frame: a clean reception desk with a laptop showing a soft, blurred diary grid, a telephone and a pen pot. On the right third: a treatment room door ajar with soft light spilling out, a coat stand and a tall plant. Keep the central half of the frame calm, dark and empty (a plain wall and clear floor), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Cool dawn light through window blinds and one warm desk lamp. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; the screen and forms show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `how-clinic-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). The reception of a small physiotherapy clinic early in the morning, seen from the waiting area. A tall composition: the warm desk lamp and the laptop with a blurred diary grid at the top, the telephone and a tidy stack of blank intake forms in the middle, a waiting-room chair and a plant near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Cool dawn light through blinds and one warm lamp. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; the screen and forms show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 10. About: garage office of a business owner

**Desktop, save as `about-garage-office-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). A converted garage used as the office of a small-business owner in England, in the evening. On the left third of the frame: shelves of lever-arch files and archive boxes, and a desk with an open laptop showing a soft, blurred spreadsheet-like screen. On the right third: a pegboard with van keys and a yellow hard hat, a kettle and two mugs on a small shelf. Keep the central half of the frame calm, dark and empty (a plain painted garage wall), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. A warm desk lamp and blue evening light from a small window. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; the screen and file labels show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `about-garage-office-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). A converted garage used as the office of a small-business owner in the evening, looking down at the desk. A tall composition: shelves of files and the glowing laptop at the top, a phone and a notebook in the middle, van keys and a mug of tea near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. A warm desk lamp and blue evening light. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; the screen and labels show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 11. Your data: quiet, secure office at night

**Desktop, save as `data-office-desktop.png`**

```
Photorealistic photograph, 16:9 landscape, 1920 x 1080 pixels (at least 1672 x 941). A small office at night, calm and secure. On the left third of the frame: a steel filing cabinet with a key in its lock and its drawers closed. On the right third: a desk with a closed laptop, its small power light glowing, and an angled desk lamp. Keep the central half of the frame calm, dark and empty (a plain dark wall), because centred website text will sit on top. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Rain on the window, blue night light and one warm lamp. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere. Keep it dark overall: it will be shown at 40% opacity behind text.
```

**Mobile, save as `data-office-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). A small office at night, calm and secure. A tall composition: the rain-streaked window and the warm desk lamp at the top, the closed laptop with its small glowing power light in the middle, the steel filing cabinet drawer with a key in its lock near the bottom. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Blue night light and one warm lamp. Palette of deep navy shadows, warm amber highlights and soft cyan, matching the attached reference image. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere. Keep it dark overall: it will be shown at 40% opacity behind text.
```

## 12. AI Agents: phone version of the existing morning photo

The AI Agents photo has no portrait version yet, so on phones it shows as a band at the top of the section. This gives it a proper phone version, like Home. Attach `public/images/agents-desktop.webp` as the reference.

**Mobile, save as `agents-mobile.png`**

```
Photorealistic photograph, 9:16 portrait, 1080 x 1920 pixels (at least 941 x 1672). The same British kitchen table as the attached reference image, early in the morning with everything in order, looking down the length of the table from one end. A tall composition: the laptop with a calm dashboard and soft green tick marks at the far end at the top, the phone with one glowing notification and a neat squared-off stack of papers in a wooden tray in the middle, a closed notebook with a pen and a steaming mug of tea in the lamp-lit foreground at the bottom. No receipts, no clutter. Keep everything within the middle 60% of the width and the left and right fifths free of anything important, because narrow phones crop them. Cinematic low-key lighting, full-frame camera, 35mm lens at f/2, shallow depth of field. Pale blue dawn light through the window and a warm pendant lamp. Palette of deep navy shadows, warm amber highlights and soft cyan. No people, faces or hands. No readable text, numbers, logos, brand names or signage anywhere; screens and paper show only soft, blurred abstract shapes. Keep it dark overall: it will be shown at 40% opacity behind text.
```
