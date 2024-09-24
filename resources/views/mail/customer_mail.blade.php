<!DOCTYPE html>
<html>
<head>
    <title>Customer Ticket</title>
</head>
<body>
<h1>Hello,</h1>
<p>You have receive ticket from a customer</p>
<p>Ticket number is: {{ $data['id'] }}</p>
<p>Customer Name: {{ $data['customer_name'] }}</p>
<p>Open Date: {{ $data['open_date'] }}</p>
<p>Subject: {{ $data['subject'] }}</p>
<p>Message: {{ $data['message'] }}</p>
</body>
</html>
