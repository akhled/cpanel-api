<?php

namespace Akhaled\CPanelAPI\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubDomainDeletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $domain;
    public $subdomain;

    public function __construct(string $domain, string $subdomain)
    {
        $this->domain = $domain;
        $this->subdomain = $subdomain;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->success()
            ->subject('Domain deleted ✅')
            ->line("❌ {{$this->subdomain}}.{{$this->domain}} was deleted successfully");
    }
}
