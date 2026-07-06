<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPassword
{
    public function toMail(mixed $notifiable): MailMessage
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $razorPath = public_path('razor-electric.svg');

        $razorImage = null;

        if (file_exists($razorPath)) {
            $razorImage = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($razorPath));
        }

        return (new MailMessage)
            ->subject('Restablecer contraseña - BarberShop')
            ->view('emails.auth.reset-password', [
                'resetUrl' => $resetUrl,
                'razorImage' => $razorImage,
                'userName' => $notifiable->nombres ?? 'usuario',
                'userEmail' => $notifiable->email,
                'requestDate' => now()->format('d/m/Y H:i:s'),
            ]);
    }
}