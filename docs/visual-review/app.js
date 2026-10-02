/* Standalone visual prototype. All example content is illustrative. */
'use strict';

if (new URLSearchParams(location.search).get('embedded') === '1') {
    document.body.classList.add('embedded');
}

const menuButton = document.querySelector('.menu-toggle');
const mobileMenu = document.querySelector('#mobile-menu');
function closeMenu() {
    mobileMenu.hidden = true;
    menuButton.setAttribute('aria-expanded', 'false');
    menuButton.setAttribute('aria-label', 'Open menu');
    menuButton.textContent = '☰';
}
menuButton?.addEventListener('click', () => {
    const opening = mobileMenu.hidden;
    mobileMenu.hidden = !opening;
    menuButton.setAttribute('aria-expanded', String(opening));
    menuButton.setAttribute('aria-label', opening ? 'Close menu' : 'Open menu');
    menuButton.textContent = opening ? '×' : '☰';
});
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && mobileMenu && !mobileMenu.hidden) {
        closeMenu();
        menuButton.focus();
    }
    if (event.key === 'Escape') document.querySelectorAll('.nav-more[open]').forEach(el => el.removeAttribute('open'));
});
document.addEventListener('click', (event) => {
    if (!event.target.closest('.nav-more')) document.querySelectorAll('.nav-more[open]').forEach(el => el.removeAttribute('open'));
});
matchMedia('(min-width:901px)').addEventListener('change', event => { if (event.matches && mobileMenu) closeMenu(); });

const tick = '<span class="tick" aria-hidden="true">✓</span>';
function demoWindow(title, content) {
    return `<div class="window-head"><span class="window-dots" aria-hidden="true"><i></i><i></i><i></i></span><span>${title}</span><span class="example-tag">Example</span></div><div class="demo-content">${content}</div>`;
}
const demos = {
    enquiries: demoWindow('Your phone · missed-call follow-up', '<p class="message-label">A TEXT TO THE CALLER</p><div class="message reply">Sorry we missed you, we’re on a job. What can we help with?</div><div class="message">Leaking tap in the kitchen. Any chance this week?</div><div class="message reply">We can do Wednesday at 2pm or Friday at 9am. Which suits?</div><div class="demo-result">' + tick + 'You get a summary. The customer gets an answer.</div>'),
    quotes: demoWindow('Quotes · follow-up', '<p class="message-label">QUOTE Q-1042 · KITCHEN REWIRE</p><div class="quote-summary"><span>Quoted from your pricing</span><strong>£2,340</strong></div><ol class="timeline"><li>' + tick + 'Quote sent<small>Monday</small></li><li>' + tick + 'Friendly nudge sent<small>Thursday</small></li><li>' + tick + 'Accepted by the customer<small>Following week</small></li></ol><div class="demo-result">' + tick + 'Invoice prepared when the job is marked done.</div>'),
    paperwork: demoWindow('Receipts · captured from a photo', '<p class="message-label">BUILDERS’ MERCHANT · 12 SEPTEMBER</p><div class="quote-summary"><span>Receipt total</span><strong>£84.60</strong></div><div class="receipt-grid"><div><small>SUPPLIER</small>Builders’ merchant</div><div><small>CATEGORY</small>Materials</div><div><small>VAT</small>£14.10</div><div><small>STATUS</small>Matched to bank</div></div><div class="demo-result">' + tick + 'Filed in your accounts. Exceptions flagged to you.</div>'),
    scheduling: demoWindow('Bookings · your calendar', '<p class="message-label">CUSTOMER BOOKING</p><div class="message">Could I move Thursday’s appointment to Friday?</div><div class="message reply">Friday at 9am is available. Shall I move it for you?</div><div class="message">Yes please, thanks.</div><div class="demo-result">' + tick + 'Diary updated. Confirmation and reminder scheduled.</div>'),
    questions: demoWindow('Your website · customer questions', '<p class="message-label">WEBSITE CHAT · 21:47</p><div class="message">Do you cover Basildon? How soon could you come out?</div><div class="message reply">Yes, we cover Basildon and the rest of south Essex. Our next free slots are Tuesday and Thursday morning.</div><div class="message">Thursday please.</div><div class="demo-result">' + tick + 'Answers from your information. Hands over when unsure.</div>'),
    reporting: demoWindow('Your week · Monday morning', '<p class="message-label">YOUR BUSINESS AT A GLANCE</p><ol class="timeline"><li>' + tick + 'Jobs booked<small>From your diary</small></li><li>' + tick + 'Quotes outstanding<small>From your quotes</small></li><li>' + tick + 'Cash due in<small>From your accounts</small></li><li>' + tick + 'Hours by person<small>From your timesheets</small></li></ol><div class="demo-result">' + tick + 'The figures you choose, sent on your schedule.</div>')
};

const homeDemo = document.querySelector('#home-demo');
if (homeDemo) {
    homeDemo.innerHTML = demos.enquiries;
    document.querySelectorAll('[data-demo]').forEach(button => button.addEventListener('click', () => {
        document.querySelectorAll('[data-demo]').forEach(el => el.setAttribute('aria-pressed', String(el === button)));
        homeDemo.innerHTML = demos[button.dataset.demo];
    }));
}

const solutions = {
    enquiries: { number:'01', title:'Enquiries and follow-up', problem:'An enquiry comes in while you are on a job. By the time you reply, they have booked someone else.', build:'An immediate reply in your voice. The right questions asked. Follow-up until there is an answer, with the conversations that matter sent to you.', steps:['Enquiry comes in','Reply and qualify','You get the details'], control:'The decision. It qualifies and follows up. You still say yes.', heading:'A missed call.<br>A conversation started.', description:'You’re on a job and can’t pick up. A text starts the conversation, collects the details and keeps you in the loop.' },
    quotes: { number:'02', title:'Quotes and invoicing', problem:'Quotes take an evening to write and a week of nudging to get answered. Invoices go out late because they get done in batches.', build:'Quotes drafted from your price list and past jobs, sent for approval, then chased on your schedule. Invoices follow when the job is marked done.', steps:['Draft from your pricing','You approve','Send and follow up'], control:'Pricing rules and the final approval on anything unusual.', heading:'A quote sent.<br>A follow-up remembered.', description:'Your price list. Your approval rules. Polite nudges on a schedule you set, with the result recorded for you.' },
    scheduling: { number:'03', title:'Scheduling and reminders', problem:'Bookings taken by phone, written in a diary, forgotten by the customer.', build:'Customers book, move or cancel within your rules. Confirmations and reminders go out, and your diary, staff diaries and job list stay in step.', steps:['Customer chooses a slot','Diaries stay in step','Reminder goes out'], control:'Who can be booked, when, for what and how much notice they need to give.', heading:'A booking moved.<br>Everyone kept in step.', description:'Customers manage appointments within the rules you choose. Your diary updates and reminders follow.' },
    questions: { number:'04', title:'Customer questions', problem:'The same twenty questions, every week, answered by whoever picks up.', build:'An assistant answers from your prices, hours, policies and business information. Questions it cannot answer go to a person with the conversation attached.', steps:['A customer asks','Your information answers','Hand over when needed'], control:'The source of truth. You change your information, its answers change.', heading:'An evening question.<br>A useful answer.', description:'Help customers with the everyday questions using your own business information, with a clear handover to you when needed.' },
    paperwork: { number:'05', title:'Paperwork and data entry', problem:'The same customer details typed into three systems by hand, and one of them always ends up wrong.', build:'Capture information once from a form, email, document photo or call note. It is checked and passed to the systems that need it.', steps:['Capture it once','Check the details','File where it belongs'], control:'Anything that needs a human check gets one. Exceptions are flagged to you.', heading:'A receipt photographed.<br>The paperwork handled.', description:'Send a photo from site. The details are read, checked and filed in your accounts, with exceptions brought to your attention.' },
    reporting: { number:'06', title:'Reporting', problem:'You know the business is busy. Finding the figures to see how it is doing takes another evening.', build:'The numbers you run your business on are pulled from your systems and sent on your schedule: jobs booked, quotes outstanding, cash due and hours by person.', steps:['Gather from your systems','Build your summary','Send on your schedule'], control:'The judgement. It shows you the numbers. You decide what to do about them.', heading:'Monday morning.<br>Your numbers, ready.', description:'A regular summary of the figures that matter to you, drawn from the systems you already use.' }
};

const solutionDetail = document.querySelector('#solution-detail');
function showSolution(key) {
    const item = solutions[key] || solutions.enquiries;
    const selectedKey = solutions[key] ? key : 'enquiries';
    document.querySelectorAll('[data-solution]').forEach(button => button.setAttribute('aria-pressed', String(button.dataset.solution === selectedKey)));
    solutionDetail.innerHTML = `<div class="solution-detail-heading"><div><p class="eyebrow">${item.number} / WHAT WE CAN TAKE OFF YOUR PLATE</p><h2>${item.title}</h2></div><span class="line-icon" aria-hidden="true">↗</span></div><div class="solution-story"><div><h3>The familiar problem</h3><p>${item.problem}</p></div><div><h3 class="cyan">What we build</h3><p>${item.build}</p></div></div><div class="workflow" aria-label="Example workflow">${item.steps.map((step,i)=>`<div><small>0${i+1}</small><strong>${step}</strong></div>`).join('')}</div><div class="control-note">${tick}<div><strong>What stays with you</strong><p>${item.control}</p></div></div><div class="solution-detail-footer"><a class="text-link" href="#solution-example">See an example <span aria-hidden="true">↓</span></a><span>Built around your business</span></div>`;
    document.querySelector('#solution-demo').innerHTML = demos[selectedKey];
    document.querySelector('#solution-demo-heading').innerHTML = item.heading;
    document.querySelector('#solution-demo-description').textContent = item.description;
}
if (solutionDetail) {
    showSolution(location.hash.slice(1));
    document.querySelectorAll('[data-solution]').forEach(button => button.addEventListener('click', () => {
        const key = button.dataset.solution;
        // Keep service choices shareable without scrolling away from the selector.
        history.replaceState(null, '', `#${key}`);
        showSolution(key);
    }));
    window.addEventListener('hashchange', () => { if (solutions[location.hash.slice(1)]) showSolution(location.hash.slice(1)); });
}

const hours = document.querySelector('#hours');
const rate = document.querySelector('#rate');
if (hours && rate) {
    const money = new Intl.NumberFormat('en-GB', {style:'currency',currency:'GBP',maximumFractionDigits:0});
    const updateCost = () => {
        document.querySelector('#hours-value').textContent = `${hours.value} ${hours.value === '1' ? 'hour' : 'hours'}`;
        document.querySelector('#rate-value').textContent = money.format(Number(rate.value));
        document.querySelector('#annual-cost').textContent = money.format(Number(hours.value) * Number(rate.value) * 46);
        hours.setAttribute('aria-valuetext', `${hours.value} hours per week`);
        rate.setAttribute('aria-valuetext', `${rate.value} pounds per hour`);
    };
    hours.addEventListener('input', updateCost);
    rate.addEventListener('input', updateCost);
    updateCost();
}

document.querySelector('[data-footer]').innerHTML = `<div class="wrap"><div class="footer-top"><div class="footer-brand"><a href="home.html"><img src="assets/ascend-logo.webp" width="200" height="36" alt="Ascend AI home" loading="lazy"></a><p>AI automation built around the way your business already works.</p></div><div class="footer-links"><div><strong>Explore</strong><a href="solutions.html">Solutions</a><a href="https://ascend-ai.co.uk/how-it-works" target="_blank" rel="noopener">How it works</a><a href="https://ascend-ai.co.uk/about" target="_blank" rel="noopener">About us</a></div><div><strong>Good to know</strong><a href="https://ascend-ai.co.uk/your-data" target="_blank" rel="noopener">Your data</a><a href="https://ascend-ai.co.uk/privacy-policy" target="_blank" rel="noopener">Privacy policy</a><a href="https://ascend-ai.co.uk/terms-and-conditions" target="_blank" rel="noopener">Terms</a></div><div><strong>Get in touch</strong><a href="mailto:contact@ascend-ai.co.uk">contact@ascend-ai.co.uk</a><a href="https://ascend-ai.co.uk/contact?type=audit" target="_blank" rel="noopener">Book a free audit ↗</a><a href="https://ascend-ai.co.uk/#newsletter-email" target="_blank" rel="noopener">Monthly automation ideas ↗</a></div></div></div><div class="footer-base"><span>© 2026 Ascend AI · Business Automation Solutions</span><span>Visual concept · 01 October 2026 · <a href="index.html" target="_top">Compare with live ↗</a></span></div></div>`;

const socialLinks = document.createElement('nav');
socialLinks.className = 'footer-socials';
socialLinks.setAttribute('aria-label', 'Social profiles');
const profiles = [['LinkedIn','https://linkedin.com/company/ascend-ai'],['YouTube','https://youtube.com/@ascend-ai'],['Instagram','https://instagram.com/ascend.ai'],['X','https://x.com/ascend_ai'],['Facebook','https://facebook.com/ascend.ai']];
profiles.forEach(([label, href]) => {
    const link = document.createElement('a');
    link.href = href;
    link.textContent = label + ' ↗';
    link.target = '_blank';
    link.rel = 'noopener';
    socialLinks.append(link);
});
document.querySelector('.footer-base').before(socialLinks);
