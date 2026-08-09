<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; color:#0E2A2E; background:#F4F7F6; padding:24px;">
  <div style="max-width:560px; margin:0 auto; background:#fff; border-radius:12px; padding:32px; border:1px solid #e2e2e2;">
    <h2 style="margin-top:0; color:#0E2A2E;">New message from the website</h2>

    <p style="margin:0 0 16px; padding:12px 14px; background:#E8F7F3; border-radius:8px; color:#0E2A2E; font-size:14px;">
      <strong>How to reply:</strong> Click <strong>Reply</strong> in your email app — your response goes straight to this visitor’s inbox.
    </p>

    <p style="margin:0 0 4px;"><strong>Name:</strong> {{ $data['name'] }}</p>
    <p style="margin:0 0 4px;">
      <strong>Email:</strong>
      <a href="mailto:{{ $data['email'] }}" style="color:#0E2A2E;">{{ $data['email'] }}</a>
    </p>
    @if(!empty($data['phone']))
      <p style="margin:0 0 4px;">
        <strong>Phone:</strong>
        <a href="tel:{{ preg_replace('/\D+/', '', $data['phone']) }}" style="color:#0E2A2E;">{{ $data['phone'] }}</a>
      </p>
    @endif
    <p style="margin:0 0 16px;"><strong>Subject:</strong> {{ $data['subject'] }}</p>
    <hr style="border:none; border-top:1px solid #eee;">
    <p style="white-space: pre-line;">{{ $data['message'] }}</p>
  </div>
</body>
</html>
