<?php

namespace Akhaled\CPanelAPI\Listeners;

use Akhaled\CPanelAPI\Events\SubDomainCreated;
use Akhaled\CPanelAPI\Notifications\SubDomainCreatedNotification;
use Exception;
use Illuminate\Support\Facades\Notification;

class SendSubDomainCreatedNotification
{
    public function handle(SubDomainCreated $event)
    {
        try {
            Notification::route('mail', config('cpanel.notifiable_email', 'test@example.org'))
                ->notify(
                    new SubDomainCreatedNotification($event->domain, $event->subdomain, $event->path)
                );
        } catch (Exception $ex) {
            logger($ex);
        }
    }
}
