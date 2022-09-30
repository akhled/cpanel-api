<?php

namespace Akhaled\CPanelAPI\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddonDomainCreated
{
    use Dispatchable, SerializesModels;

    public $domain;
    public $subdomain;
    public $path;

    public function __construct(string $domain, string $subdomain, string $path)
    {
        $this->domain = $domain;
        $this->subdomain = $subdomain;
        $this->path = $path;
    }
}
