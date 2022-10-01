<?php

namespace Akhaled\CPanelAPI\Listeners;

use Akhaled\CPanelAPI\Events\AddonDomainCreated;
use Akhaled\CPanelAPI\Notifications\AddonDomainCreatedNotification;
use Exception;
use Illuminate\Support\Facades\Notification;

class SendAddonDomainCreatedNotification
{
    public function handle(AddonDomainCreated $event)
    {
        try {
            Notification::route('mail', [
                config('cpanel.notifiable_email') => config('cpanel.notifiable_name')
            ])->notify(
                new AddonDomainCreatedNotification($event->domain, $event->subdomain, $event->path)
            );
        } catch (Exception $ex) {
            logger($ex);
        }
    }
}
