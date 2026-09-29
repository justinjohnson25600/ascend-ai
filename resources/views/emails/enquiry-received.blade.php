<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanks, we've got your enquiry</title>
    <style>
        body { margin: 0; padding: 0; background: #f4f6f9; font-family: Arial, Helvetica, sans-serif; color: #1f2937; }
        .wrap { max-width: 560px; margin: 0 auto; padding: 32px 20px; }
        .card { background: #ffffff; border-radius: 12px; padding: 32px; border: 1px solid #e5e7eb; }
        .brand { font-size: 18px; font-weight: bold; letter-spacing: 2px; color: #0a0f1c; margin: 0 0 24px; }
        .brand span { color: #0284c7; border: 1px solid #0284c7; border-radius: 4px; padding: 0 5px; margin-left: 4px; }
        p { font-size: 15px; line-height: 1.6; margin: 0 0 16px; }
        .note { background: #f0f9ff; border-left: 3px solid #0ea5e9; padding: 12px 16px; border-radius: 6px; font-size: 14px; color: #075985; }
        .button { display: inline-block; background: #0ea5e9; color: #ffffff !important; text-decoration: none; font-weight: bold; padding: 12px 22px; border-radius: 8px; }
        .small { font-size: 13px; color: #6b7280; }
        .sign { margin-top: 24px; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <p class="brand">ASCEND<span>AI</span></p>

            <p>Hi {{ $greetingName }},</p>

            <p>Thanks for getting in touch with Ascend AI.</p>

            <p class="note">This reply went out automatically the moment your enquiry arrived. It is a small example of what we build.</p>

            <p>A person reads every enquiry, and you will hear from us within one working day.</p>

            @if ($bookingUrl)
                <p>If you would rather not wait, pick a time for your free 30 minute automation audit:</p>
                <p><a class="button" href="{{ $bookingUrl }}">Pick a time</a></p>
            @endif

            <p><strong>You asked about:</strong> {{ $enquiryLabel }}</p>

            <p class="small">If you did not send this, you can ignore it and we will not contact you again.</p>

            <p class="sign">
                Justin Johnson<br>
                Ascend AI, Business Automation Solutions<br>
                <a href="mailto:{{ config('ascend.company.email') }}">{{ config('ascend.company.email') }}</a>
            </p>
        </div>
    </div>
</body>
</html>
