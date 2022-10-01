<?php

namespace Akhaled\CPanelAPI\Listeners;

use Akhaled\CPanelAPI\Events\AddonDomainDeleted;
use Akhaled\CPanelAPI\Notifications\AddonDomainDeletedNotification;
use Exception;
use Illuminate\Support\Facades\Notification;

class SendAddonDomainDeletedNotification
{
    public function handle(AddonDomainDeleted $event)
    {
        try {
            Notification::route('mail', [
                config('cpanel.notifiable_email') => config('cpanel.notifiable_name')
            ])->notify(
                new AddonDomainDeletedNotification($event->domain, $event->subdomain)
            );
        } catch (Exception $ex) {
            logger($ex);
        }
    }
}
