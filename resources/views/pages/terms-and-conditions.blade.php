<x-layout.app :title="$title" :description="$description">
    {{-- Hero Section --}}
    <section class="bg-navy-950 py-20 relative overflow-hidden">
        {{-- Background gradient effect --}}
        <div class="absolute inset-0 bg-gradient-to-br from-accent-500/10 via-transparent to-purple-500/10 pointer-events-none"></div>
        <div class="hero-circuit" aria-hidden="true">
            <svg viewBox="0 0 1200 600" preserveAspectRatio="none">
                <g class="circuit-lines">
                    <path d="M40 60 H260 V140 H420 V110 H620 V220 H840" />
                    <path class="alt" d="M80 520 H320 V430 H520 V500 H760 V380 H1020" />
                    <path d="M200 40 V240 H140 V320 H420 V280 H660 V90 H980" />
                    <path class="alt" d="M60 300 H240 V230 H380 V330 H560 V210 H740" />
                    <path d="M700 60 V220 H900 V300 H1120" />
                    <path class="alt" d="M500 360 V520 H740 V460 H940" />
                    <path d="M120 120 H320 V200 H520 V160 H720 V260 H960" />
                    <path class="alt" d="M180 480 H380 V380 H600 V440 H820 V320 H1080" />
                    <path d="M260 100 V280 H220 V360 H500 V320 H740 V120 H1060" />
                    <path class="alt" d="M100 260 H300 V200 H460 V300 H640 V180 H820" />
                    <path d="M760 120 V260 H980 V340 H1160" />
                    <path class="alt" d="M560 320 V500 H800 V420 H1020" />
                    <path d="M300 80 H520 V180 H700 V140 H900 V240 H1100" />
                    <path class="alt" d="M140 340 H360 V260 H540 V360 H720 V240 H900" />
                    <path d="M420 60 V240 H360 V320 H600 V280 H860 V100 H1140" />
                    <path class="alt" d="M220 540 H440 V460 H640 V520 H880 V400 H1120" />
                </g>
                <g class="circuit-nodes">
                    <circle cx="280" cy="170" r="2" />
                    <circle cx="420" cy="120" r="2" />
                    <circle cx="610" cy="240" r="2" />
                    <circle cx="340" cy="420" r="2" />
                    <circle cx="520" cy="500" r="2" />
                    <circle cx="740" cy="380" r="2" />
                    <circle cx="160" cy="340" r="2" />
                    <circle cx="440" cy="300" r="2" />
                    <circle cx="640" cy="110" r="2" />
                    <circle cx="260" cy="240" r="2" />
                    <circle cx="360" cy="340" r="2" />
                    <circle cx="520" cy="220" r="2" />
                    <circle cx="930" cy="320" r="2" />
                    <circle cx="720" cy="460" r="2" />
                    <circle cx="320" cy="200" r="2" />
                    <circle cx="520" cy="160" r="2" />
                    <circle cx="720" cy="260" r="2" />
                    <circle cx="380" cy="380" r="2" />
                    <circle cx="600" cy="440" r="2" />
                    <circle cx="820" cy="320" r="2" />
                    <circle cx="220" cy="360" r="2" />
                    <circle cx="500" cy="320" r="2" />
                    <circle cx="740" cy="120" r="2" />
                    <circle cx="300" cy="200" r="2" />
                    <circle cx="460" cy="300" r="2" />
                    <circle cx="640" cy="180" r="2" />
                    <circle cx="980" cy="340" r="2" />
                    <circle cx="800" cy="420" r="2" />
                    <circle cx="700" cy="140" r="2" />
                    <circle cx="900" cy="240" r="2" />
                    <circle cx="360" cy="320" r="2" />
                    <circle cx="600" cy="280" r="2" />
                    <circle cx="860" cy="100" r="2" />
                    <circle cx="440" cy="460" r="2" />
                    <circle cx="640" cy="520" r="2" />
                    <circle cx="880" cy="400" r="2" />
                </g>
                <g class="circuit-pulses">
                    <path class="pulse pulse-1" d="M40 60 H260 V140 H420 V110 H620 V220 H840" />
                    <path class="pulse pulse-2" d="M80 520 H320 V430 H520 V500 H760 V380 H1020" />
                    <path class="pulse pulse-3" d="M200 40 V240 H140 V320 H420 V280 H666 V90 H980" />
                    <path class="pulse pulse-4" d="M500 360 V520 H740 V460 H940" />
                    <path class="pulse pulse-5" d="M120 120 H320 V200 H520 V160 H720 V260 H960" />
                    <path class="pulse pulse-6" d="M180 480 H380 V380 H600 V440 H820 V320 H1080" />
                    <path class="pulse pulse-7" d="M300 80 H520 V180 H700 V140 H900 V240 H1100" />
                    <path class="pulse pulse-8" d="M140 340 H360 V260 H540 V360 H720 V240 H900" />
                </g>
            </svg>
        </div>

        <div class="container relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <p class="text-sm text-accent-400 mb-4">Last Updated: January 2026 | Version: 1.0</p>
                <h1 class="text-display-md md:text-display-lg font-bold text-white mb-6">Terms & Conditions</h1>
                <p class="text-gray-400 mb-8">These Terms and Conditions govern your use of the Ascend AI website and outline the terms for our investment, partnership, and advisory services.</p>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="bg-navy-900 py-16">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                {{-- Navigation --}}
                <div class="bg-navy-800 rounded-lg p-6 mb-12">
                    <h3 class="text-white mb-4">Quick Navigation</h3>
                    <nav class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                        <a href="#introduction" class="text-accent-400 hover:text-accent-300">1. Introduction</a>
                        <a href="#information" class="text-accent-400 hover:text-accent-300">2. Information About Us</a>
                        <a href="#definitions" class="text-accent-400 hover:text-accent-300">3. Definitions</a>
                        <a href="#website-use" class="text-accent-400 hover:text-accent-300">4. Website Use</a>
                        <a href="#intellectual-property" class="text-accent-400 hover:text-accent-300">5. Intellectual Property</a>
                        <a href="#services" class="text-accent-400 hover:text-accent-300">6. Services & Engagements</a>
                        <a href="#investment" class="text-accent-400 hover:text-accent-300">7. Investment Terms</a>
                        <a href="#consultancy" class="text-accent-400 hover:text-accent-300">8. Advisory Services</a>
                        <a href="#joint-ventures" class="text-accent-400 hover:text-accent-300">9. Joint Ventures</a>
                        <a href="#confidentiality" class="text-accent-400 hover:text-accent-300">10. Confidentiality</a>
                        <a href="#liability" class="text-accent-400 hover:text-accent-300">11. Limitation of Liability</a>
                        <a href="#ai-disclaimers" class="text-accent-400 hover:text-accent-300">12. AI Disclaimers</a>
                        <a href="#termination" class="text-accent-400 hover:text-accent-300">13. Termination</a>
                        <a href="#governing-law" class="text-accent-400 hover:text-accent-300">14. Governing Law</a>
                        <a href="#general" class="text-accent-400 hover:text-accent-300">15. General Provisions</a>
                        <a href="#contact" class="text-accent-400 hover:text-accent-300">16. Contact</a>
                    </nav>
                </div>

                <div class="prose prose-invert prose-lg max-w-none">
                    {{-- Section 1: Introduction --}}
                    <h2 id="introduction" class="text-2xl font-bold text-white mt-12 mb-4">1. Introduction</h2>
                    <p class="text-gray-300 mb-4">Welcome to the Ascend AI website located at <strong>ascend-ai.co.uk</strong> (the "Site"). These Terms and Conditions ("Terms") govern your use of the Site and any services offered through it.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">Acceptance of Terms</h3>
                    <p class="text-gray-300 mb-4">By accessing or using our Site, you acknowledge that you have read, understood, and agree to be bound by these Terms. If you do not agree with these Terms, please do not use our Site.</p>
                    <p class="text-gray-300 mb-4"><strong>For businesses and organisations:</strong> By submitting an enquiry, you confirm that you have the authority to bind your organisation to these Terms.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">Age Requirement</h3>
                    <p class="text-gray-300 mb-4">You must be at least 18 years old to use this Site or submit enquiries. By using our Site, you represent and warrant that you are 18 years or older.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 2: Information About Ascend AI --}}
                    <h2 id="information" class="text-2xl font-bold text-white mt-12 mb-4">2. Information About Ascend AI</h2>
                    <p class="text-gray-300 mb-4"><strong>Ascend AI</strong> is a venture studio that builds and operates AI-centric SaaS companies. We are registered in England and Wales and operate from the United Kingdom.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">What We Do</h3>
                    <p class="text-gray-300 mb-4">We build and operate software companies with artificial intelligence at their core, seek investment partners who bring strategic value beyond capital, form joint ventures with partners who contribute domain expertise and market access, and provide selective advisory services on AI-native methodologies.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">What We Don't Do (on This Website)</h3>
                    <p class="text-gray-300 mb-4">Our Site is for informational purposes only. Through this Site, we do NOT sell products or services directly, process payments or financial transactions, create user accounts or authentication, or provide investment advice or financial recommendations.</p>
                    <p class="text-gray-300 mb-4"><strong>Important:</strong> Any investment, partnership, or advisory engagement will be governed by separate written agreements tailored to the specific opportunity.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 3: Definitions --}}
                    <h2 id="definitions" class="text-2xl font-bold text-white mt-12 mb-4">3. Definitions</h2>
                    <p class="text-gray-300 mb-4">In these Terms, the following terms have the meanings below:</p>
                    <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                        <li class="mb-1"><strong>"Ascend AI", "we", "us", "our"</strong> refers to Ascend AI, the venture studio operating this website.</li>
                        <li class="mb-1"><strong>"You", "your"</strong> refers to you, whether as an individual or on behalf of an organisation.</li>
                        <li class="mb-1"><strong>"Site"</strong> means the website located at ascend-ai.co.uk and all related pages.</li>
                        <li class="mb-1"><strong>"Content"</strong> means all text, graphics, logos, images, software, and other materials on the Site.</li>
                        <li class="mb-1"><strong>"Services"</strong> means the investment opportunities, partnership arrangements, and advisory services that may be offered by Ascend AI.</li>
                        <li class="mb-1"><strong>"Enquiry"</strong> means any communication submitted through our contact form.</li>
                        <li class="mb-1"><strong>"Portfolio Companies"</strong> refers to the AI-centric SaaS companies built and operated by Ascend AI.</li>
                        <li class="mb-1"><strong>"Confidential Information"</strong> has the meaning set out in the Confidentiality section below.</li>
                        <li><strong>"User"</strong> means any person or entity accessing or using the Site.</li>
                    </ul>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 4: Website Use --}}
                    <h2 id="website-use" class="text-2xl font-bold text-white mt-12 mb-4">4. Website Use</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">4.1 Permitted Use</h3>
                    <p class="text-gray-300 mb-4">You may use our Site for browsing our content to learn about Ascend AI, submitting enquiries about investment, partnership, or advisory opportunities, and accessing our contact information for legitimate business purposes.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">4.2 Prohibited Uses</h3>
                    <p class="text-gray-300 mb-4">You agree NOT to use the Site for any illegal purpose or in violation of any applicable laws, attempt to gain unauthorised access to any part of the Site, our servers, or our systems, use automated systems (bots, scrapers, crawlers) to access the Site without our express written permission, interfere with or disrupt the Site or servers connected to the Site, use the Site to transmit malicious code, viruses, or any harmful software, copy, reproduce, modify, distribute, or create derivative works from our Content without permission, harvest or collect email addresses or other contact information from the Site, or impersonate Ascend AI or any person or entity.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">4.3 Account Security</h3>
                    <p class="text-gray-300 mb-4">If you create an account or provide any information that requires authentication, you must maintain the confidentiality of your login credentials, notify us immediately of any unauthorised use of your account, and accept full responsibility for all activities that occur under your account. We are not responsible for any loss or damage from your failure to comply with this obligation.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 5: Intellectual Property --}}
                    <h2 id="intellectual-property" class="text-2xl font-bold text-white mt-12 mb-4">5. Intellectual Property Rights</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">5.1 Ownership of Content</h3>
                    <p class="text-gray-300 mb-4">All Content on this Site is owned by or licensed to Ascend AI and is protected by copyright, trademark, and other intellectual property laws. This includes text, graphics, logos, and images, software, code, and scripts, design, layout, and visual elements, our methodology, frameworks, and proprietary processes, and the Ascend AI name, logo, and branding.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">5.2 Restrictions on Use</h3>
                    <p class="text-gray-300 mb-4">Without our express written permission, you may NOT copy, reproduce, or distribute our Content, modify, adapt, or create derivative works based on our Content, use our Content for commercial purposes (except as permitted by law), or remove any copyright, trademark, or other proprietary notices from our Content.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">5.3 Ascend AI Methodology</h3>
                    <p class="text-gray-300 mb-4">Our AI-centric business methodology and frameworks are confidential trade secrets. You may not copy, imitate, or replicate our business model or methodologies, use our proprietary frameworks or processes without permission, or reverse-engineer our systems or processes.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">5.4 Submissions and Ideas</h3>
                    <p class="text-gray-300 mb-4">If you submit ideas, suggestions, or proposals to us through our contact form, we may use your submission without any obligation of confidentiality, we are not obligated to compensate you for your submission, you grant us a perpetual, royalty-free licence to use your submission, and we have the right to use similar submissions from others without liability.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 6: Services & Engagements --}}
                    <h2 id="services" class="text-2xl font-bold text-white mt-12 mb-4">6. Services & Engagements</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">6.1 Information Only</h3>
                    <p class="text-gray-300 mb-4">The content on this Site is for informational purposes only. It does not constitute professional advice (legal, financial, technical, or otherwise), an offer to sell any services or products, an invitation to treat for contract formation, or investment advice or financial recommendations.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">6.2 No Contractual Obligation</h3>
                    <p class="text-gray-300 mb-4">Submitting an enquiry does NOT create any contractual obligation between you and Ascend AI. We are free to accept or decline any enquiry at our sole discretion.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">6.3 Separate Agreements Required</h3>
                    <p class="text-gray-300 mb-4">Any actual engagement with Ascend AI—including investment, joint ventures, or advisory services—will require a separate written agreement signed by both parties, detailed terms specific to that engagement, and due diligence on both sides as appropriate. These Site Terms do NOT govern such future engagements.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 7: Investment Opportunities --}}
                    <h2 id="investment" class="text-2xl font-bold text-white mt-12 mb-4">7. Investment Opportunities</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">7.1 Nature of Investment Enquiries</h3>
                    <p class="text-gray-300 mb-4">Enquiries about investment opportunities do NOT constitute an offer to sell securities, do NOT guarantee any returns or outcomes, and are expressions of interest only, not offers.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">7.2 No Financial Advice</h3>
                    <p class="text-gray-300 mb-4">Our Site does NOT provide investment advice or recommendations, financial planning advice, tax advice, or any form of regulated financial services.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">7.3 Investment Risks</h3>
                    <p class="text-gray-300 mb-4">You acknowledge that investing in early-stage software companies carries substantial risk, you may lose all or part of your investment, past performance of portfolio companies is not indicative of future results, and you should seek independent professional advice before investing.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">7.4 No FCA Regulation</h3>
                    <p class="text-gray-300 mb-4">Ascend AI is NOT regulated by the Financial Conduct Authority (FCA) and does NOT provide regulated financial services. Any investment discussions are unregulated.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 8: Advisory Services --}}
                    <h2 id="consultancy" class="text-2xl font-bold text-white mt-12 mb-4">8. Advisory & Consultancy Services</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">8.1 Advisory Service Scope</h3>
                    <p class="text-gray-300 mb-4">Where Ascend AI provides advisory or consultancy services, services are educational and strategic in nature, we do not implement technology or systems on your behalf, we do not manage your business operations, and we provide guidance on AI-native methodologies, not implementation services.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">8.2 Separate Engagement Required</h3>
                    <p class="text-gray-300 mb-4">Any advisory engagement will be governed by a separate written agreement specifying scope of services (what we will and will not provide), deliverables (what we will produce), timeline, fees and payment terms, limitation of liability, and termination provisions.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">8.3 Not Implementation Services</h3>
                    <p class="text-gray-300 mb-4">Unless expressly agreed in writing, we do NOT write code for your systems, do NOT configure your technology infrastructure, do NOT manage your AI implementation projects, and our advisory services are strategic and educational only.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 9: Joint Ventures --}}
                    <h2 id="joint-ventures" class="text-2xl font-bold text-white mt-12 mb-4">9. Joint Ventures & Partnerships</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">9.1 Partnership Enquiries</h3>
                    <p class="text-gray-300 mb-4">Expressions of interest in joint ventures or partnerships do NOT create any binding agreement, are subject to mutual due diligence and negotiation, and require separate legal documentation if accepted.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">9.2 Due Diligence</h3>
                    <p class="text-gray-300 mb-4">Before entering any partnership arrangement, Ascend AI will conduct background checks on potential partners, verify claims about market access or domain expertise, and assess strategic fit with our methodology. We reserve the right to decline any partnership opportunity without explanation.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">9.3 Joint Venture Terms</h3>
                    <p class="text-gray-300 mb-4">Any joint venture will be governed by a separate agreement covering ownership structure and capital contributions, roles, responsibilities, and decision-making rights, profit sharing and loss allocation, exit provisions and buy-sell arrangements, intellectual property ownership (background IP vs. foreground IP), and non-compete and non-solicit obligations.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 10: Confidentiality --}}
                    <h2 id="confidentiality" class="text-2xl font-bold text-white mt-12 mb-4">10. Confidentiality</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">10.1 Your Obligations</h3>
                    <p class="text-gray-300 mb-4">During any discussions or engagements, you may have access to Confidential Information. You agree to keep all Confidential Information strictly confidential, not use Confidential Information for any purpose other than our discussions, not disclose Confidential Information to any third party without our prior written consent, and take reasonable measures to protect the security of Confidential Information.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">10.2 What Constitutes Confidential Information</h3>
                    <p class="text-gray-300 mb-4">"Confidential Information" means all non-public information disclosed by Ascend AI, including our business methodologies, frameworks, and processes, technical information, trade secrets, or know-how, business plans, financial information, or strategies, information about our portfolio companies, and any information marked as "confidential".</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">10.3 Exclusions from Confidentiality</h3>
                    <p class="text-gray-300 mb-4">Your obligations do NOT apply to information that is or becomes public knowledge through no fault of yours, was already known to you before disclosure, is independently developed by you without reference to our Confidential Information, or is required to be disclosed by law or court order.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">10.4 End of Obligations</h3>
                    <p class="text-gray-300 mb-4">Your confidentiality obligations survive the end of any discussions or engagements and continue indefinitely unless the information enters the public domain through no fault of yours.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 11: Limitation of Liability --}}
                    <h2 id="liability" class="text-2xl font-bold text-white mt-12 mb-4">11. Limitation of Liability</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">11.1 Website Use</h3>
                    <p class="text-gray-300 mb-4">To the fullest extent permitted by law (and subject to your statutory rights as a consumer), Ascend AI shall NOT be liable for any indirect, incidental, special, or consequential damages, loss of profits, data, business opportunities, or goodwill, interruption of business operations, or system failures or website downtime.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">11.2 Content Accuracy</h3>
                    <p class="text-gray-300 mb-4">While we strive to ensure our Content is accurate and up-to-date, we make NO warranties about the completeness, reliability, or accuracy of the Content, we do NOT guarantee that the Site will be uninterrupted or error-free, we do NOT guarantee that any errors will be corrected, and the Site is provided "as is" without warranties of any kind.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">11.3 Liability Cap</h3>
                    <p class="text-gray-300 mb-4">Our total aggregate liability to you for all claims arising from or related to the Site shall NOT exceed, for website use: no monetary cap (but subject to the exclusions below), and for paid services: the amount you paid for the relevant services.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">11.4 Exclusions from Liability</h3>
                    <p class="text-gray-300 mb-4">We are NOT liable for actions taken based on information you obtained from our Site, decisions you make based on our Content, business outcomes, losses, or damages arising from your use of our Site, or third-party websites linked from our Site.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">11.5 Fundamental Rights</h3>
                    <p class="text-gray-300 mb-4">Nothing in these Terms excludes or limits our liability for death or personal injury caused by our negligence, fraudulent or deceitful conduct, or matters for which it would be unlawful to exclude or limit liability.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 12: AI Disclaimers --}}
                    <h2 id="ai-disclaimers" class="text-2xl font-bold text-white mt-12 mb-4">12. AI-Specific Disclaimers</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">12.1 AI Methodology Information</h3>
                    <p class="text-gray-300 mb-4">Our Site describes our AI-centric business methodology. You acknowledge that our methodologies are proprietary and may not be replicated without our permission, results described from our portfolio companies are not guaranteed outcomes, what works for one company or market may not work for another, and our approach involves continuous evolution and experimentation.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">12.2 No AI Services on This Website</h3>
                    <p class="text-gray-300 mb-4">This website does NOT provide AI tools or software that you can use, use AI to generate content for you, or offer AI-as-a-service products. Any AI services would be provided through separate portfolio companies, not through this Site.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">12.3 AI Output Limitations</h3>
                    <p class="text-gray-300 mb-4">You acknowledge that AI technologies (which may be used in our portfolio companies or future services) have inherent limitations: AI outputs may be incomplete, inaccurate, or inappropriate, AI systems may "hallucinate" or generate false information, and AI should be used with human oversight and verification.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">12.4 Data Training</h3>
                    <p class="text-gray-300 mb-4"><strong>We do NOT use your personal data to train AI models.</strong> For clarity: contact form submissions are NOT used for AI training, we do NOT feed your emails into any machine learning system, we do NOT use your enquiries to fine-tune AI models, and your communications remain private and are used only for responding to your enquiry.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">12.5 Portfolio Company Disclaimers</h3>
                    <p class="text-gray-300 mb-4">Our portfolio companies are separate legal entities. Their privacy policies may differ from ours, their terms of service are separate and independent, and their data practices are governed by their own policies. Links from our Site to portfolio companies do NOT constitute our endorsement of their data practices.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 13: Termination --}}
                    <h2 id="termination" class="text-2xl font-bold text-white mt-12 mb-4">13. Termination</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">13.1 Right to Terminate</h3>
                    <p class="text-gray-300 mb-4">We reserve the right to suspend or terminate your access to our Site immediately, without prior notice or liability, for breach of these Terms, use of the Site for illegal or fraudulent purposes, abusive behaviour towards our team or other users, or any reason or no reason, at our sole discretion.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">13.2 Effect of Termination</h3>
                    <p class="text-gray-300 mb-4">Upon termination, your right to use the Site ceases immediately, we may delete your account and any personal data we hold (subject to legal retention requirements), and provisions of these Terms that by their nature should survive termination will continue in force.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 14: Governing Law --}}
                    <h2 id="governing-law" class="text-2xl font-bold text-white mt-12 mb-4">14. Governing Law & Jurisdiction</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">14.1 Governing Law</h3>
                    <p class="text-gray-300 mb-4">These Terms are governed by and construed in accordance with the laws of <strong>England and Wales</strong>.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">14.2 Jurisdiction</h3>
                    <p class="text-gray-300 mb-4">Any disputes arising from or relating to these Terms or your use of the Site shall be subject to the <strong>exclusive jurisdiction of the courts of England and Wales</strong>.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">14.3 International Users</h3>
                    <p class="text-gray-300 mb-4">If you access our Site from outside the UK, you do so on your own initiative and are responsible for compliance with local laws, we make no representation that our Site is appropriate or available in your location, these Terms (and English law) govern your use of the Site, and we do NOT guarantee that our Site complies with laws outside England and Wales.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 15: General Provisions --}}
                    <h2 id="general" class="text-2xl font-bold text-white mt-12 mb-4">15. General Provisions</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">15.1 Entire Agreement</h3>
                    <p class="text-gray-300 mb-4">These Terms, together with our Privacy Policy, constitute the entire agreement between you and Ascend AI regarding your use of the Site. These Terms supersede all prior discussions, negotiations, or agreements (whether written or oral) relating to the subject matter.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">15.2 Severability</h3>
                    <p class="text-gray-300 mb-4">If any provision of these Terms is found to be invalid, illegal, or unenforceable by a court of competent jurisdiction, that provision will be limited or deleted to the minimum extent necessary so that the remaining provisions will remain in full force and effect. The invalidity or unenforceability of any provision of these Terms will not affect the validity or enforceability of the remaining provisions.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">15.3 Waiver</h3>
                    <p class="text-gray-300 mb-4">Our failure to enforce or exercise any right or provision of these Terms will NOT constitute a waiver of such right or provision. Our waiver of any breach or default of these Terms will NOT be deemed a waiver of any subsequent breach or default.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">15.4 Assignment</h3>
                    <p class="text-gray-300 mb-4">You may NOT assign or transfer your rights or obligations under these Terms without our prior written consent. We may freely assign or transfer our rights and obligations under these Terms to any successor or affiliate.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">15.5 Third-Party Rights</h3>
                    <p class="text-gray-300 mb-4">These Terms are for the benefit of Ascend AI and you. Nothing in these Terms is intended to benefit, nor shall create any rights in, any third party.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">15.6 Force Majeure</h3>
                    <p class="text-gray-300 mb-4">We are not liable for any failure or delay in performing our obligations where such failure or delay is caused by circumstances beyond our reasonable control, including acts of God, war, civil unrest, or terrorism, pandemics, epidemics, or public health crises, natural disasters, severe weather, or geological events, government actions, strikes, or labour disputes, internet infrastructure failures, power outages, or communication failures, or actions or omissions of third-party service providers.</p>
                    <p class="text-gray-300 mb-4">If affected by force majeure, we will notify you as soon as practicable and resume performance when the circumstances are resolved.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">15.7 No Waiver of Consumer Rights</h3>
                    <p class="text-gray-300 mb-4">Nothing in these Terms affects your statutory rights as a consumer under UK law, including (but not limited to) the Consumer Rights Act 2015, the Consumer Contracts (Information, Cancellation and Additional Charges) Regulations 2013, the Data Protection Act 2018, and the Unfair Contract Terms Act 1977.</p>
                    <p class="text-gray-300 mb-4">If any provision of these Terms is found to be unfair or unreasonable under the Unfair Contract Terms Act 1977, it will not bind you, but you may still choose to rely on it if you wish.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Section 16: Contact --}}
                    <h2 id="contact" class="text-2xl font-bold text-white mt-12 mb-4">16. Contact Information</h2>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">16.1 General Enquiries</h3>
                    <p class="text-gray-300 mb-4">For questions about these Terms or our Site, contact us at:</p>
                    <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                        <li class="mb-1"><strong>Email:</strong> contact@ascend-ai.co.uk</li>
                        <li><strong>Website:</strong> ascend-ai.co.uk</li>
                    </ul>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">16.2 Legal Enquiries</h3>
                    <p class="text-gray-300 mb-4">For legal matters, please direct your enquiry to "Legal Department" at the above email address.</p>

                    <h3 class="text-xl font-semibold text-white mt-8 mb-3">16.3 Document Changes</h3>
                    <p class="text-gray-300 mb-4">We may update these Terms from time to time. Changes will be posted on this page with an updated "Last Updated" date. Material changes (affecting your rights) will be communicated via notice on our website and email notification where we have your contact details. Your continued use of the Site after changes constitutes acceptance of the new Terms.</p>

                    <hr class="border-navy-700 my-8">

                    {{-- Disclaimer --}}
                    <div class="bg-navy-800 rounded-lg p-6 text-sm text-gray-400 mt-8">
                        <h4 class="text-white mb-4">Important Legal Notice</h4>
                        <p class="mb-4">These Terms and Conditions are for information purposes only and do not constitute legal advice. Terms and conditions for investment, partnership, or advisory engagements will be set out in separate written agreements tailored to each opportunity.</p>
                        <p class="mb-4">If you do not understand any aspect of these Terms, we recommend seeking independent legal advice before using our Site or submitting any enquiries.</p>
                        <p>We also recommend seeking professional advice if you are considering investment or partnership opportunities, as these carry significant risks and require careful consideration.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
