
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome Letter</title>
    <style>
        /* Add your custom styling here */
    </style>
</head>
<body>
<div class="container">
    <p>Dear {{$user->name}},</p>
    <p>We received a request to reset your password. To do so, please click on the link below:</p>
    <p><a href="{{ route('reset.password', $token) }}">Reset Password Now</a></p>
    <p>If you did not request this change, please ignore this email.</p>
    <p>Thank you,<br>The ILDM Team</p>
</div>

</body>
</html>
