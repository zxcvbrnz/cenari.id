<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Membuat URL reset password
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Kata Sandi - CENARI ID') // Subjek Email
            ->greeting('Halo, ' . $notifiable->name . '!') // Sapaan
            ->line('Kami menerima permintaan reset kata sandi untuk akun Anda di Cenari.')
            ->action('Reset Kata Sandi Sekarang', $url) // Label Tombol
            ->line('Tautan reset kata sandi ini akan kedaluwarsa dalam 60 menit.')
            ->line('Jika Anda tidak merasa meminta ini, abaikan saja email ini.')
            ->salutation('Salam hangat, Tim CENARI ID');
    }
}
