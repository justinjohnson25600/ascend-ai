@php
    $company = config('ascend.company');
    $address = implode(', ', $company['address']);
    $sections = [
        ['who-we-are', '1. Who we are'],
        ['scope', '2. What this policy covers'],
        ['information', '3. Information we collect'],
        ['use', '4. How we use it and why we are allowed to'],
        ['client-data', '5. Client data we process on your behalf'],
        ['sharing', '6. Who we share information with'],
        ['transfers', '7. International transfers'],
        ['retention', '8. How long we keep information'],
        ['security', '9. Security'],
        ['rights', '10. Your rights'],
        ['cookies', '11. Cookies'],
        ['children', '12. Children'],
        ['changes', '13. Changes to this policy'],
        ['complaints', '14. Complaints and contact'],
    ];
@endphp
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="Privacy Policy"
        subtitle="How Ascend AI collects, uses and protects personal information, whether you visit this site, send an enquiry, join the newsletter, or become a client."
        :fullHeight="false"
    />

    <section class="bg-navy-900 py-16">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <p class="text-sm text-accent-400 mb-8 reveal-up">Last updated: September 2026. Version 2.1.</p>

                <div class="bg-navy-800 rounded-lg p-6 mb-12 reveal-up">
                    <h3 class="text-white mb-4">On this page</h3>
                    <nav class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                        @foreach ($sections as [$id, $label])
                            <a href="#{{ $id }}" class="text-accent-400 hover:text-accent-300">{{ $label }}</a>
                        @endforeach
                    </nav>
                </div>

                <div class="prose prose-invert prose-lg max-w-none">
                    <div class="reveal-up">
                        <h2 id="who-we-are" class="text-2xl font-bold text-white mt-12 mb-4">1. Who we are</h2>
                        <p class="text-gray-300 mb-4">Ascend AI ("we", "us") provides business automation services to small businesses in the United Kingdom. We are the data controller for the personal information described in sections 3 and 4.</p>
                        <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                            <li class="mb-1"><strong>Trading name:</strong> {{ $company['name'] }}</li>
                            <li class="mb-1"><strong>Address:</strong> {{ $address }}</li>
                            <li class="mb-1"><strong>Email:</strong> {{ $company['email'] }}</li>
                            <li><strong>Website:</strong> ascend-ai.co.uk</li>
                        </ul>
                        <p class="text-gray-300 mb-4">We comply with the UK General Data Protection Regulation (UK GDPR), the Data Protection Act 2018 and the Privacy and Electronic Communications Regulations (PECR).</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="scope" class="text-2xl font-bold text-white mt-12 mb-4">2. What this policy covers</h2>
                        <p class="text-gray-300 mb-4">This policy applies to personal information we handle as a <strong>controller</strong>: visitors to this website, people who send us an enquiry or book an audit, newsletter subscribers, and the business contacts of our clients.</p>
                        <p class="text-gray-300 mb-4">When we build and run automation for a client, we also handle information belonging to that client and its customers. There we act as a <strong>processor</strong> on the client's instructions. Section 5 explains how that works. The client's own privacy notice governs what its customers are told.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="information" class="text-2xl font-bold text-white mt-12 mb-4">3. Information we collect</h2>
                        <h3 class="text-xl font-semibold text-white mt-8 mb-3">3.1 When you send an enquiry or book an audit</h3>
                        <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                            <li class="mb-1">Your name and email address</li>
                            <li class="mb-1">Your business name, if you give it</li>
                            <li class="mb-1">What you need help with and the message you write</li>
                            <li>Anything you tell us during the audit call and the notes we take</li>
                        </ul>
                        <h3 class="text-xl font-semibold text-white mt-8 mb-3">3.2 When you join the newsletter</h3>
                        <p class="text-gray-300 mb-4">Your email address, the date you subscribed, and whether you later unsubscribe.</p>
                        <h3 class="text-xl font-semibold text-white mt-8 mb-3">3.3 When you become a client</h3>
                        <p class="text-gray-300 mb-4">Contact details for the people we work with at your business, billing details, scope documents, correspondence, and records of the work we do.</p>
                        <h3 class="text-xl font-semibold text-white mt-8 mb-3">3.4 Collected automatically</h3>
                        <p class="text-gray-300 mb-4">Our web server keeps standard access logs, which include your IP address, the pages requested and your browser type. We use these only to keep the site secure and working. We do not use analytics or advertising trackers on this site.</p>
                        <h3 id="chat" class="text-xl font-semibold text-white mt-8 mb-3 scroll-mt-32">3.5 When you use the chat on this website</h3>
                        <p class="text-gray-300 mb-4">The messages you type into the website assistant are sent to our AI provider, Anthropic, so it can write replies. The conversation is held in your browser session on our server only while your visit lasts, so the assistant can follow it, and is deleted when the session ends. We do not keep chat transcripts. If you ask the assistant to put you in touch, we keep your name, email address and the summary you agree to, in the same way as a contact form enquiry. Please do not type sensitive personal details into the chat.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="use" class="text-2xl font-bold text-white mt-12 mb-4">4. How we use it and why we are allowed to</h2>
                        <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                            <li class="mb-2"><strong>Replying to your enquiry and running the audit.</strong> Lawful basis: taking steps at your request before entering a contract, and our legitimate interest in responding to people who contact us.</li>
                            <li class="mb-2"><strong>Delivering and supporting services to clients.</strong> Lawful basis: performance of our contract with you.</li>
                            <li class="mb-2"><strong>Sending the newsletter.</strong> Lawful basis: your consent, which you can withdraw at any time using the link in every email or by emailing us.</li>
                            <li class="mb-2"><strong>Invoicing, accounting and tax records.</strong> Lawful basis: legal obligation.</li>
                            <li class="mb-2"><strong>Answering questions in the website chat.</strong> Lawful basis: our legitimate interest in answering visitors' questions; and, if you ask us to contact you, taking steps at your request before entering a contract.</li>
                            <li class="mb-2"><strong>Keeping the website and our systems secure.</strong> Lawful basis: legitimate interest.</li>
                            <li><strong>Establishing or defending legal claims.</strong> Lawful basis: legitimate interest.</li>
                        </ul>
                        <p class="text-gray-300 mb-4">We do not sell personal information and we do not use it for automated decisions that have a legal or similarly significant effect on you.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="client-data" class="text-2xl font-bold text-white mt-12 mb-4">5. Client data we process on your behalf</h2>
                        <p class="text-gray-300 mb-4">To build and run automation we usually need access to a client's systems: for example a calendar, an inbox, an accounts package or a customer list. That access is granted by the client, limited to what the agreed scope needs, and can be revoked by the client at any time.</p>
                        <p class="text-gray-300 mb-4">In that role we:</p>
                        <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                            <li class="mb-1">act only on the client's documented instructions, as set out in the scope;</li>
                            <li class="mb-1">keep the data within the client's own systems wherever the design allows;</li>
                            <li class="mb-1">use sub-processors only as named in the scope (see section 6) and tell the client before any change;</li>
                            <li class="mb-1">choose AI model providers whose terms do not permit training on the data we send them;</li>
                            <li class="mb-1">help the client respond to requests from individuals about their data;</li>
                            <li>delete or return the data at the end of the engagement, as the client instructs.</li>
                        </ul>
                        <p class="text-gray-300 mb-4">A data processing agreement setting this out in full is available to every client on request and forms part of our terms.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="sharing" class="text-2xl font-bold text-white mt-12 mb-4">6. Who we share information with</h2>
                        <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                            <li class="mb-2"><strong>Hosting and infrastructure providers</strong> that run this website and the automation we build.</li>
                            <li class="mb-2"><strong>Email and messaging providers</strong> used to send enquiry notifications, the newsletter and automated messages on behalf of clients.</li>
                            <li class="mb-2"><strong>AI model providers</strong> used within client automation, named in each client's scope, and Anthropic, which writes the replies in this website's chat.</li>
                            <li class="mb-2"><strong>Software connected to a client's automation</strong> at the client's instruction, such as their accounts or booking system.</li>
                            <li class="mb-2"><strong>Professional advisers</strong> such as our accountants, where necessary.</li>
                            <li><strong>Authorities</strong> where the law requires it.</li>
                        </ul>
                        <p class="text-gray-300 mb-4">Each provider is bound by contract to protect the information and use it only to provide their service to us.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="transfers" class="text-2xl font-bold text-white mt-12 mb-4">7. International transfers</h2>
                        <p class="text-gray-300 mb-4">Some providers, in particular AI model providers, process data outside the United Kingdom. Where that happens we rely on the UK's adequacy regulations or the International Data Transfer Agreement, and we choose providers with appropriate security certifications. Clients can ask us to restrict a design to UK or EU processing, and we will say in the scope if that is not possible.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="retention" class="text-2xl font-bold text-white mt-12 mb-4">8. How long we keep information</h2>
                        <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                            <li class="mb-1"><strong>Enquiries and audit documents:</strong> three years from our last contact with you.</li>
                            <li class="mb-1"><strong>Client records:</strong> for the length of the engagement and twelve months afterwards, except financial records, which we keep for six years as the law requires.</li>
                            <li class="mb-1"><strong>Client data processed on your behalf:</strong> for the length of the engagement, then deleted or returned as you instruct.</li>
                            <li class="mb-1"><strong>Newsletter:</strong> until you unsubscribe. We keep a record that you unsubscribed so we do not email you again.</li>
                            <li class="mb-1"><strong>Website chat:</strong> for your visit only, then deleted when your session ends (after two hours without activity at most). Details you ask us to act on are kept as an enquiry, above.</li>
                            <li><strong>Server logs:</strong> ninety days.</li>
                        </ul>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="security" class="text-2xl font-bold text-white mt-12 mb-4">9. Security</h2>
                        <p class="text-gray-300 mb-4">Information is transmitted over encrypted connections and stored on access-controlled systems. Access to client systems uses credentials or permissions granted by the client, kept in an encrypted secrets store, and limited to the people working on that client's project. We review access when a project ends. No system is perfectly secure, and if a breach affects your information we will tell you and the Information Commissioner's Office as the law requires.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="rights" class="text-2xl font-bold text-white mt-12 mb-4">10. Your rights</h2>
                        <p class="text-gray-300 mb-4">You can ask us to:</p>
                        <ul class="list-disc list-inside text-gray-300 mb-4 ml-4">
                            <li class="mb-1">tell you what personal information we hold about you and give you a copy;</li>
                            <li class="mb-1">correct information that is wrong;</li>
                            <li class="mb-1">delete information, where we have no lawful reason to keep it;</li>
                            <li class="mb-1">stop or restrict a particular use, including all marketing;</li>
                            <li class="mb-1">give you your information in a portable format;</li>
                            <li>withdraw consent you have given, at any time.</li>
                        </ul>
                        <p class="text-gray-300 mb-4">Email {{ $company['email'] }}. We respond within one month. If your request concerns data we process for one of our clients, we will pass it to them and help them respond.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="cookies" class="text-2xl font-bold text-white mt-12 mb-4">11. Cookies</h2>
                        <p class="text-gray-300 mb-4">This site sets only the cookies it needs to work: a session cookie and a security token that protects forms from misuse. Neither identifies you or tracks you across other sites, and neither needs your consent under PECR. We do not use analytics, advertising or social media cookies. If that changes, we will ask for your consent first.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="children" class="text-2xl font-bold text-white mt-12 mb-4">12. Children</h2>
                        <p class="text-gray-300 mb-4">Our services are for businesses. We do not knowingly collect information from anyone under 18. If you believe a child has given us information, email us and we will delete it.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="changes" class="text-2xl font-bold text-white mt-12 mb-4">13. Changes to this policy</h2>
                        <p class="text-gray-300 mb-4">We will update this page when our practices change and update the date at the top. If a change materially affects clients or subscribers, we will email them.</p>
                    </div>

                    <hr class="border-navy-700 my-8">

                    <div class="reveal-up">
                        <h2 id="complaints" class="text-2xl font-bold text-white mt-12 mb-4">14. Complaints and contact</h2>
                        <p class="text-gray-300 mb-4">Questions and complaints go to {{ $company['email'] }} or to {{ $address }}. If you are not satisfied with our response you can complain to the Information Commissioner's Office at <a href="https://ico.org.uk" class="text-accent-400 hover:text-accent-300" target="_blank" rel="noopener noreferrer">ico.org.uk</a> or on 0303 123 1113.</p>
                    </div>

                    <div class="bg-navy-800 rounded-lg p-6 text-sm text-gray-400 mt-8 reveal-up">
                        <p>This policy explains our practices in plain language and is not legal advice. Clients receive a data processing agreement that takes precedence where the two differ.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
