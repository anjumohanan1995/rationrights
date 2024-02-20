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
    <table style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px;">
        <tr>
            <td>
                <p>Dear {{ $validatedData['full_name'] }},</p>
                <p>Your application for the MBA has been successfully registed.</p>
                <p>Name : {{ $validatedData['full_name'] }}</p>
                <p>Application Number : {{ $validatedData['application_number'] }}</p>
                <p>Secret Password : {{ $password }}</p>
                <p>We have included your secret password, Please don't share your password with others.</p>
                <p>If you have any questions or need assistance, feel free to contact our support team.</p>
                <p>Best regards,</p>
                <p>Your ILDM Team</p>
            </td>
        </tr>
    </table>
</body>
</html>
