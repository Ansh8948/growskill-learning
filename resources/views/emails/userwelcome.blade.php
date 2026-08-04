<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
<style>
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    body { margin: 0; padding: 0; width: 100% !important; height: 100% !important; background-color: #f4f6f8; font-family: 'Segoe UI', Helvetica, Arial, sans-serif; }

    @media only screen and (max-width: 600px) {
        .email-container { width: 100% !important; }
        .fluid-padding { padding-left: 20px !important; padding-right: 20px !important; }
        .hero-title { font-size: 22px !important; }
    }

    @media (prefers-color-scheme: dark) {
        .email-bg { background-color: #121212 !important; }
        .card-bg { background-color: #1e1e1e !important; }
        .text-main { color: #f0f0f0 !important; }
        .text-muted { color: #a0a0a0 !important; }
    }
</style>
</head>
<body class="email-bg" style="margin:0; padding:0; background-color:#f4f6f8;">

<div style="display:none; max-height:0; overflow:hidden; mso-hide:all;">
    Welcome to GrowSkill, {{ $user->name }}! Your account is ready.
</div>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8;">
    <tr>
        <td align="center" style="padding: 30px 15px;">

            <table role="presentation" class="email-container card-bg" width="600" cellpadding="0" cellspacing="0" style="width:600px; max-width:600px; background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.06);">

                <!-- Header -->
                <tr>
                    <td align="center" style="background: linear-gradient(135deg, #6a5ae0, #4f7df3); padding: 40px 20px;">
                        <h1 class="hero-title" style="margin:0; color:#ffffff; font-size:26px; font-weight:700;">
                            Welcome to GrowSkill 🎉
                        </h1>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td class="fluid-padding text-main" style="padding: 35px 40px; color:#2d2d2d; font-size:15px; line-height:1.6;">
                        <p style="margin:0 0 16px;">Hello <strong>{{ $user->name }}</strong>,</p>

                        <p style="margin:0 0 16px;">
                            Thank you for registering on GrowSkill.
                        </p>

                        <p style="margin:0 0 24px;">
                            Your account has been created successfully.
                        </p>

                        <!-- Info card -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f8fc; border-radius:8px; margin-bottom:28px;">
                            <tr>
                                <td style="padding: 18px 22px;">
                                    <p class="text-muted" style="margin:0 0 6px; font-size:13px; color:#7a7a7a; text-transform:uppercase; letter-spacing:0.5px;">NAME</p>
                                    <p style="margin:0; font-size:15px; font-weight:600; color:#2d2d2d; word-break:break-all;">{{ $user->name }}</p>
                                    <p class="text-muted" style="margin:0 0 6px; font-size:13px; color:#7a7a7a; text-transform:uppercase; letter-spacing:0.5px;">Email</p>
                                    <p style="margin:0; font-size:15px; font-weight:600; color:#2d2d2d; word-break:break-all;">{{ $user->email }}</p>
                                    <p class="text-muted" style="margin:0 0 6px; font-size:13px; color:#7a7a7a; text-transform:uppercase; letter-spacing:0.5px;">PASSWORD</p>
                                    <p style="margin:0; font-size:15px; font-weight:600; color:#2d2d2d; word-break:break-all;">{{ $user->password }}</p>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 24px;">Happy Learning!</p>

                        <!-- Signature -->
                        <table role="presentation" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td style="padding-top: 10px; border-top: 1px solid #f0f0f0;">
                                    <p style="margin:14px 0 2px; font-size:14px; color:#6a6a6a;">Regards,</p>
                                    <p style="margin:0; font-size:16px; font-weight:700; color:#4f7df3; letter-spacing:0.3px;">
                                        GrowSkill Team
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td align="center" class="fluid-padding" style="padding: 24px 40px 32px; background-color:#fafbfd;">
                        <p class="text-muted" style="margin:0; font-size:12px; color:#9a9a9a;">
                            © {{ date('Y') }} GrowSkill. All rights reserved.
                        </p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>