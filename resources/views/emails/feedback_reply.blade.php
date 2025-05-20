<h3>Hi {{ $feedback->name }},</h3>

<p>Thank you for your feedback:</p>
<blockquote>{{ $feedback->comment }}</blockquote>

<p><strong>Our Response:</strong></p>
<p>{{ $feedback->reply }}</p>

<p>Best regards,<br>Restaurant Team</p>
