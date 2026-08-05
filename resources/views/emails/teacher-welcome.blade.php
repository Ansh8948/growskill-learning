<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome Teacher</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:30px;">

<div style="max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:10px;">

    <h2 style="color:#6d28d9;">
        Welcome to GrowSkill 🎉
    </h2>

    <p>Hello <strong>{{ $teacher->name }}</strong>,</p>

    <p>
        Congratulations! Your teacher account has been created successfully.
    </p>

    <table cellpadding="8">
        <tr>
            <td><strong>Name</strong></td>
            <td>{{ $teacher->name }}</td>
        </tr>

        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $teacher->email }}</td>
        </tr>
    </table>

    <p>
        You can now login and start creating courses on GrowSkill.
    </p>

    <p>
        Best Wishes,<br>
        <strong>GrowSkill Team</strong>
    </p>

</div>

</body>
</html>