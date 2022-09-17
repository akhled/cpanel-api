<?php

namespace Akhaled\CPanelAPI\Notifications;

use Akhaled\CPanelAPI\Mail\SubDomainCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;

class SubDomainCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $domain;
    public $subdomain;
    public $path;

    public function __construct(string $domain, string $subdomain, string $path)
    {
        $this->domain = $domain;
        $this->subdomain = $subdomain;
        $this->path = $path;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $address = $notifiable instanceof AnonymousNotifiable
            ? $notifiable->routeNotificationFor('mail')
            : $notifiable->email;

        return (new SubDomainCreatedMail($this->domain, $this->subdomain, $this->path))
            ->to($address);
    }
}
