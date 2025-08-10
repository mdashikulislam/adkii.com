<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendPasswordResetOtp extends Notification
{
    use Queueable;
    protected $otp;
    protected $token;

    public function __construct($otp,$token)
    {
        $this->otp = $otp;
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->email], false));

        return (new MailMessage)
            ->subject('Password Reset OTP and Link')
            ->line('Your OTP code is: ' . $this->otp)
            ->line('You can also reset your password using this link:')
            ->action('Reset Password', $resetUrl)
            ->line('OTP expires in 15 minutes.');
    }
}
