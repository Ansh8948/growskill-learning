<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to GrowSkill</title>
</head>
<body>

    <h2>Welcome to GrowSkill, {{ $user->name }}!</h2>

    <p>
        You have successfully logged in to your GrowSkill account.
    </p>

    <p>
        Email: {{ $user->email }}
    </p>

    <p>
        Thank you for being a part of GrowSkill.
    </p>

    <br>

    <p>
        Regards,<br>
        GrowSkill Team
    </p>

</body>
</html>