<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #1a1a2e;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background: #f4f4f4;
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #555;
        }
        .field-value {
            margin-top: 5px;
            padding: 10px;
            background: white;
            border-left: 3px solid #3498db;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Contact Form Submission</h2>
    </div>
    <div class="content">
        <div class="field">
            <div class="field-label">Name:</div>
            <div class="field-value">{{ $contactData['name'] }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email:</div>
            <div class="field-value">
                <a href="mailto:{{ $contactData['email'] }}">{{ $contactData['email'] }}</a>
            </div>
        </div>

        @if(!empty($contactData['organisation']))
        <div class="field">
            <div class="field-label">Organisation:</div>
            <div class="field-value">{{ $contactData['organisation'] }}</div>
        </div>
        @endif

        <div class="field">
            <div class="field-label">Enquiry Type:</div>
            <div class="field-value">{{ ucfirst($contactData['enquiry_type']) }}</div>
        </div>

        <div class="field">
            <div class="field-label">Message:</div>
            <div class="field-value">{{ $contactData['message'] }}</div>
        </div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

        <p style="font-size: 12px; color: #888;">
            Submitted: {{ now()->format('d M Y H:i:s') }}<br>
            IP Address: {{ request()->ip() }}
        </p>
    </div>
</body>
</html>
