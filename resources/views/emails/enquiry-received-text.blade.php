Hi {{ $greetingName }},

Thanks for getting in touch with Ascend AI. This reply went out automatically the moment your enquiry arrived. It is a small example of what we build.

A person reads every enquiry, and you will hear from us within one working day.
@if ($bookingUrl)

If you would rather not wait, pick a time for your free 30 minute automation audit:
{{ $bookingUrl }}
@endif

You asked about: {{ $enquiryLabel }}

If you did not send this, you can ignore it and we will not contact you again.

Justin Johnson
Ascend AI, Business Automation Solutions
{{ config('ascend.company.email') }}
