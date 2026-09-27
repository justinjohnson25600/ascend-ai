@php
    $company = config('ascend.company');
    $address = implode(', ', $company['address']);
    $sections = [
        ['about', '1. About these terms'],
        ['definitions', '2. Words we use'],
        ['audit', '3. The audit'],
        ['scope', '4. Scoping and agreeing work'],
        ['fees', '5. Fees and payment'],
        ['stages', '6. Stages and acceptance'],
        ['ongoing', '7. The ongoing service'],
        ['your-side', '8. What we need from you'],
        ['third-parties', '9. Third-party services'],
        ['ip', '10. Who owns what'],
        ['data', '11. Data protection and confidentiality'],
        ['liability', '12. Warranties and liability'],
        ['ending', '13. Ending the engagement'],
        ['general', '14. General'],
        ['law', '15. Law and disputes'],
    ];
@endphp
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="Terms and Conditions"
        subtitle="The terms on which Ascend AI provides audits, automation development and the ongoing service to business clients."
        :ctaText="null"
        :fullHeight="false"
    />

    <section class="bg-navy-900 py-16">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <p class="text-sm text-accent-400 mb-8">Last updated: September 2026. Version 2.0.</p>

                <div class="bg-navy-800 rounded-lg p-6 mb-12">
                    <h3 class="text-white mb-4">On this page</h3>
                    <nav class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                        @foreach ($sections as [$id, $label])
                            <a href="#{{ $id }}" class="text-accent-400 hover:text-accent-300">{{ $label }}</a>
                        @endforeach
                    </nav>
                </div>

                <div class="prose prose-invert prose-lg max-w-none">
                    <h2 id="about" class="text-2xl font-bold text-white mt-12 mb-4">1. About these terms</h2>
                    <p class="text-gray-300 mb-4">These terms apply to every audit, scope and service provided by {{ $company['name'] }} of {{ $address }} ("we", "us") to a business client ("you"). They apply together with each scope document you accept. If a scope document and these terms conflict, the scope document wins for that stage.</p>
                    <p class="text-gray-300 mb-4">Our services are for businesses. By booking an audit or accepting a scope you confirm you are acting in the course of a business and have authority to bind it.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="definitions" class="text-2xl font-bold text-white mt-12 mb-4">2. Words we use</h2>
                    <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                        <li class="mb-1"><strong>Audit:</strong> the free initial call and the written document that follows it.</li>
                        <li class="mb-1"><strong>Scope:</strong> the written description of a Stage that we send you and you accept, including its price and timescale.</li>
                        <li class="mb-1"><strong>Stage:</strong> a defined piece of automation built and switched on under one Scope.</li>
                        <li class="mb-1"><strong>Setup Fee:</strong> the one-off fee for access, hosting foundations and the first detailed Scope.</li>
                        <li class="mb-1"><strong>Development Fee:</strong> the fixed fee for building a Stage.</li>
                        <li class="mb-1"><strong>Ongoing Fee:</strong> the monthly fee for hosting, monitoring, support and small changes once a Stage is live.</li>
                        <li class="mb-1"><strong>Deliverables:</strong> the automation, configuration and documentation we create for you under a Scope.</li>
                        <li><strong>Your Systems:</strong> the software, accounts and data you give us access to.</li>
                    </ul>

                    <hr class="border-navy-700 my-8">

                    <h2 id="audit" class="text-2xl font-bold text-white mt-12 mb-4">3. The audit</h2>
                    <p class="text-gray-300 mb-4">The Audit is free and places no obligation on either of us. The Audit document is our honest opinion based on what you tell us during the call. It is provided as-is, for your information, and is not a quotation, a guarantee of outcomes, or professional advice on legal, tax or regulatory matters.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="scope" class="text-2xl font-bold text-white mt-12 mb-4">4. Scoping and agreeing work</h2>
                    <p class="text-gray-300 mb-4">Every Stage begins with a Scope. A Scope becomes binding when you accept it in writing, which includes email, or when you pay the fee it describes. Each Scope states what the Stage does, which of Your Systems it connects to, what we need from you, the Development Fee, the Ongoing Fee that applies once it is live, and an estimated timescale.</p>
                    <p class="text-gray-300 mb-4">Anything not written in the Scope is not included. If you want something added or changed during a Stage, we will tell you the effect on price and time and issue a revised Scope for you to accept before we do it.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="fees" class="text-2xl font-bold text-white mt-12 mb-4">5. Fees and payment</h2>
                    <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                        <li class="mb-2">The <strong>Setup Fee</strong> is invoiced when you accept the first Scope and is payable before work begins.</li>
                        <li class="mb-2">The <strong>Development Fee</strong> for each Stage is fixed in its Scope. Unless the Scope says otherwise, half is invoiced on acceptance and half when the Stage goes live. Larger projects are split into several Stages, so Development Fees may be invoiced more than once while the build is underway.</li>
                        <li class="mb-2">The <strong>Ongoing Fee</strong> is invoiced monthly in advance from the date the first Stage goes live, and adjusts as further Stages go live, as stated in each Scope.</li>
                        <li class="mb-2">Invoices are payable within 14 days. All fees exclude VAT, which is added where applicable.</li>
                        <li class="mb-2">If an invoice is overdue we may charge interest and compensation under the Late Payment of Commercial Debts (Interest) Act 1998, and after 14 days' written notice we may pause work or suspend the Ongoing Service until the account is settled.</li>
                        <li>Fees are not refundable once a Stage has started, except where these terms say otherwise.</li>
                    </ul>

                    <hr class="border-navy-700 my-8">

                    <h2 id="stages" class="text-2xl font-bold text-white mt-12 mb-4">6. Stages and acceptance</h2>
                    <p class="text-gray-300 mb-4">We build each Stage, test it with your real data where you allow, and switch it on. A Stage is accepted when you confirm it in writing, or ten working days after it goes live if you have not reported a failure to meet its Scope, or when you begin using it for your business, whichever is first.</p>
                    <p class="text-gray-300 mb-4">If a Stage does not do what its Scope says, tell us and we will fix it at no extra charge. Requests that go beyond the Scope are handled under section 4.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="ongoing" class="text-2xl font-bold text-white mt-12 mb-4">7. The ongoing service</h2>
                    <p class="text-gray-300 mb-4">While you pay the Ongoing Fee we will:</p>
                    <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                        <li class="mb-1">host and run the Deliverables;</li>
                        <li class="mb-1">monitor them and investigate failures;</li>
                        <li class="mb-1">fix faults in our work at no extra charge;</li>
                        <li class="mb-1">make small changes within the allowance stated in your Scope;</li>
                        <li>acknowledge support requests within one working day and keep you informed until resolved.</li>
                    </ul>
                    <p class="text-gray-300 mb-4">The Ongoing Fee does not cover new Stages, changes beyond the allowance, or rebuilding work made necessary by a change to a third-party service. We will quote for those separately and tell you before doing anything chargeable. We may need short planned maintenance windows and will give notice where we can.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="your-side" class="text-2xl font-bold text-white mt-12 mb-4">8. What we need from you</h2>
                    <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                        <li class="mb-1">Timely access to Your Systems and the people who understand them.</li>
                        <li class="mb-1">Accurate information about how your business works. We rely on it when designing the Deliverables.</li>
                        <li class="mb-1">Prompt responses to questions and approvals. Delays on your side extend timescales.</li>
                        <li class="mb-1">Confirmation that you have the right to give us access to Your Systems and the data in them, and that your use of the Deliverables complies with the law, including data protection and marketing rules that apply to messages sent to your customers.</li>
                        <li>Review of anything the Deliverables send to third parties on your behalf until you are satisfied with it. You remain responsible for communications sent in your name.</li>
                    </ul>

                    <hr class="border-navy-700 my-8">

                    <h2 id="third-parties" class="text-2xl font-bold text-white mt-12 mb-4">9. Third-party services</h2>
                    <p class="text-gray-300 mb-4">The Deliverables connect to services we do not control: AI model providers, your accounts, booking and messaging software, and similar. Their availability, pricing and terms are theirs. You may need your own subscription to some of them, as stated in the Scope. We are not responsible for outages or changes in those services, but we will tell you when one affects you and quote for any work needed to adapt.</p>
                    <p class="text-gray-300 mb-4">AI models can produce inaccurate output. We design the Deliverables so that they answer from your information, hand over to a person where the Scope says so, and can be reviewed by you. You are responsible for checking output that matters before acting on it.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="ip" class="text-2xl font-bold text-white mt-12 mb-4">10. Who owns what</h2>
                    <p class="text-gray-300 mb-4">Once the fees for a Stage are paid in full, you own the Deliverables built specifically for you under that Scope, including their configuration and documentation. If you end the Ongoing Service we will hand them over with documentation so that another provider can run them.</p>
                    <p class="text-gray-300 mb-4">We keep ownership of our own tools, templates, methods and know-how, including anything we developed before or independently of your project. Where those are embedded in your Deliverables, you have a perpetual, non-exclusive licence to use them as part of the Deliverables. Third-party components remain subject to their own licences. Your data remains yours throughout.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="data" class="text-2xl font-bold text-white mt-12 mb-4">11. Data protection and confidentiality</h2>
                    <p class="text-gray-300 mb-4">When we process personal data in Your Systems on your behalf we act as your processor, and our data processing agreement applies. It is available on request and forms part of these terms. Our <a href="{{ route('privacy-policy') }}" class="text-accent-400 hover:text-accent-300">Privacy Policy</a> explains how we handle personal data as a controller.</p>
                    <p class="text-gray-300 mb-4">Each of us will keep the other's confidential information private and use it only for the engagement, for the duration of the engagement and three years afterwards. This does not apply to information that is public, already known, or required to be disclosed by law. We may name you as a client and describe the work in general terms only with your written agreement.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="liability" class="text-2xl font-bold text-white mt-12 mb-4">12. Warranties and liability</h2>
                    <p class="text-gray-300 mb-4">We will provide our services with reasonable skill and care and will make the Deliverables do what their Scope says. We do not promise particular business results, savings or revenue, and any figures discussed during the Audit or scoping are estimates.</p>
                    <p class="text-gray-300 mb-4">Nothing in these terms limits liability for death or personal injury caused by negligence, for fraud, or for anything else that cannot lawfully be limited.</p>
                    <p class="text-gray-300 mb-4">Subject to that, neither of us is liable to the other for loss of profit, revenue, business, data or goodwill, or for any indirect or consequential loss. Our total liability to you arising from all services in any twelve-month period is limited to the fees you paid us in that period.</p>

                    <hr class="border-navy-700 my-8">

                    <h2 id="ending" class="text-2xl font-bold text-white mt-12 mb-4">13. Ending the engagement</h2>
                    <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                        <li class="mb-2">Either of us may end the Ongoing Service by giving 30 days' written notice. Fees are payable to the end of the notice period.</li>
                        <li class="mb-2">You may cancel a Stage before it goes live by written notice. We will invoice for work done to that point, up to the Development Fee.</li>
                        <li class="mb-2">Either of us may end the engagement immediately if the other seriously breaches these terms and does not put it right within 14 days of being asked, or becomes insolvent.</li>
                        <li>On ending, we hand over the Deliverables under section 10 once outstanding fees are paid, remove our access to Your Systems, and delete or return your data as you instruct.</li>
                    </ul>

                    <hr class="border-navy-700 my-8">

                    <h2 id="general" class="text-2xl font-bold text-white mt-12 mb-4">14. General</h2>
                    <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                        <li class="mb-1">These terms and the accepted Scopes are the whole agreement between us and replace earlier discussions.</li>
                        <li class="mb-1">We may update these terms for future work. The version in force when you accept a Scope applies to that Stage.</li>
                        <li class="mb-1">Neither of us may transfer this agreement without the other's consent, except that we may use subcontractors under our supervision and remain responsible for them.</li>
                        <li class="mb-1">Notices must be in writing by email to the addresses each of us uses for the engagement.</li>
                        <li class="mb-1">Neither of us is liable for delay caused by events outside reasonable control, provided we tell you promptly.</li>
                        <li>If any part of these terms is found unenforceable, the rest still applies. No one other than you and us may enforce them.</li>
                    </ul>

                    <hr class="border-navy-700 my-8">

                    <h2 id="law" class="text-2xl font-bold text-white mt-12 mb-4">15. Law and disputes</h2>
                    <p class="text-gray-300 mb-4">These terms are governed by the law of England and Wales. If a dispute arises, the people responsible on each side will meet, in person or by call, and try in good faith to resolve it within 30 days before either of us starts legal proceedings. The courts of England and Wales have exclusive jurisdiction.</p>
                    <p class="text-gray-300 mb-4">Questions about these terms: {{ $company['email'] }}.</p>

                    <div class="bg-navy-800 rounded-lg p-6 text-sm text-gray-400 mt-8">
                        <p>These terms are written in plain language on purpose. Where a signed agreement or data processing agreement exists between us, it takes precedence over this page.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
