<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;

class SubDomain
{
    private $api;
    private $domain;

    function __construct(CPanelAPI $api, string $domain = null)
    {
        $this->api = $api;
        $this->domain = $domain;
    }

    public function delete(string $subdomain)
    {
        return $this->api->raw("subdomain/dodeldomain.html?domain=${subdomain}.{$this->domain}");
    }
}
