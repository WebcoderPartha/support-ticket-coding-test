<!DOCTYPE html>
<html>
<head>
    <title>Your ticket has been closed</title>
</head>
<body>
<h1>Hello,{{ $data['customer']['name'] }} </h1>
<p>Your ticket has been closed</p>
<p>Ticket number is: {{ $data['id'] }}</p>
<p>Open Date: {{ $data['open_date'] }}</p>
<p>Subject: {{ $data['subject'] }}</p>
<p>If you face still issues please create a ticket again. Will will fixed the issues.</p>
<p>Thank you</p>
</body>
</html>
