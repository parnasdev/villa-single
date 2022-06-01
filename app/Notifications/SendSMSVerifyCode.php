<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class SendSMSVerifyCode extends KavenegarBaseNotification
{
    use Queueable;

    public function toKavenegar($notifiable)
    {
        return (new KavenegarMessage())
        ->verifyLookup('verifyCode',["$notifiable->token"]);
    }
}
