<?php

namespace Akhaled\CPanelAPI\Listeners;

use Akhaled\CPanelAPI\Events\SubDomainDeleted;
use Akhaled\CPanelAPI\Notifications\SubDomainDeletedNotification;
use Exception;
use Illuminate\Support\Facades\Notification;

class SendSubDomainDeletedNotification
{
    public function handle(SubDomainDeleted $event)
    {
        try {
            Notification::route('mail', [
                config('cpanel.notifiable_email') => config('cpanel.notifiable_name', 'test@example.org')
            ])->notify(
                new SubDomainDeletedNotification($event->domain, $event->subdomain)
            );
        } catch (Exception $ex) {
            logger($ex);
        }
    }
}
