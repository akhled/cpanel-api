<?php

namespace Akhaled\CPanelAPI\Listeners;

use Akhaled\CPanelAPI\Events\SubDomainCreated;
use Akhaled\CPanelAPI\Notifications\SubDomainCreatedNotification;
use Illuminate\Support\Facades\Notification;

class SendSubDomainCreatedNotification
{
    public function handle(SubDomainCreated $event)
    {
        Notification::route('mail', config('cpanel.notifiable_email'))
            ->notify(
                new SubDomainCreatedNotification($event->domain, $event->subdomain, $event->path)
            );
    }
}
