<?php

namespace Akhaled\CPanelAPI\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddonDomainDeleted
{
    use Dispatchable, SerializesModels;

    public $domain;
    public $subdomain;

    public function __construct(string $domain, string $subdomain)
    {
        $this->domain = $domain;
        $this->subdomain = $subdomain;
    }
}
