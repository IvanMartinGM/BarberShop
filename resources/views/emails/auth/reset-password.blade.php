<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña - BarberShop</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f5f5f4; font-family: Arial, sans-serif; color: #1c1917;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f4; padding: 32px 16px;">
        <tr>
            <td align="center">

                <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 620px; background-color: #ffffff; border-radius: 18px; overflow: hidden; box-shadow: 0 12px 30px rgba(0,0,0,0.12);">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #ffffff; padding: 32px 24px 20px; border-bottom: 1px solid #e7e5e4;">

                            @if (!empty($razorImage))
                                <div style="display: inline-block; background-color: #ef2329; border-radius: 50%; width: 58px; height: 58px; line-height: 58px; text-align: center; margin-bottom: 14px;">
                                    <img src="{{ $razorImage }}" alt="BarberShop" style="width: 30px; height: 30px; vertical-align: middle;">
                                </div>
                            @endif

                            <h1 style="margin: 0; color: #1d4ed8; font-size: 34px; font-weight: 800; letter-spacing: 1px;">
                                ✂️ BARBERSHOP
                            </h1>

                            <p style="margin: 8px 0 0; color: #57534e; font-size: 15px;">
                                Sistema de Gestión para Barbería
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 34px 34px 24px;">

                            <h2 style="margin: 0 0 16px; color: #1c1917; font-size: 24px;">
                                Hola {{ $userName ?? 'usuario' }} 👋
                            </h2>

                            <p style="margin: 0 0 16px; color: #44403c; font-size: 16px; line-height: 1.6;">
                                Recibimos una solicitud para restablecer la contraseña de tu cuenta en BarberShop.
                            </p>

                            <p style="margin: 0 0 22px; color: #44403c; font-size: 16px; line-height: 1.6;">
                                Para continuar, haz clic en el siguiente botón:
                            </p>

                            <div style="text-align: center; margin: 32px 0;">
                                <a href="{{ $resetUrl }}"
                                   style="display: inline-block; background-color: #dc2626; color: #ffffff; text-decoration: none; font-weight: 700; font-size: 16px; padding: 14px 28px; border-radius: 12px;">
                                    Restablecer contraseña
                                </a>
                            </div>

                            <div style="background-color: #fef2f2; border-left: 4px solid #dc2626; padding: 14px 16px; border-radius: 10px; margin-bottom: 24px;">
                                <p style="margin: 0; color: #7f1d1d; font-size: 14px; line-height: 1.5;">
                                    Este enlace es temporal. Si tú no solicitaste este cambio, puedes ignorar este correo.
                                </p>
                            </div>

                            <p style="margin: 0 0 8px; color: #57534e; font-size: 14px;">
                                <strong>Fecha de solicitud:</strong> {{ $requestDate }}
                            </p>

                            <p style="margin: 0; color: #57534e; font-size: 14px;">
                                <strong>Correo asociado:</strong> {{ $userEmail }}
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #1d4ed8; padding: 22px 24px;">
                            <p style="margin: 0; color: #ffffff; font-size: 14px; font-weight: 700;">
                                BarberShop
                            </p>

                            <p style="margin: 6px 0 0; color: #dbeafe; font-size: 13px;">
                                Cuidando tu estilo, también cuidamos tu cuenta.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>