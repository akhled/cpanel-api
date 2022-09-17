<?php

namespace Akhaled\CPanelAPI\Listeners;

use Akhaled\CPanelAPI\Events\SubDomainDeleted;
use Akhaled\CPanelAPI\Notifications\SubDomainDeletedNotification;
use Illuminate\Support\Facades\Notification;

class SendSubDomainDeletedNotification
{
    public function handle(SubDomainDeleted $event)
    {
        Notification::route('mail', [
            config('cpanel.notifiable_email') => config('cpanel.notifiable_name')
        ])->notify(
            new SubDomainDeletedNotification($event->domain, $event->subdomain)
        );
    }
}
