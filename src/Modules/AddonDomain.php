<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;

class AddonDomain
{
    private $api;

    function __construct(CPanelAPI $api)
    {
        $this->api = $api;
    }

    public function create(string $domain, string $subdomain, string $dir, string $root_domain)
    {
        return $this->api->raw("addon/doadddomain.html?domain=${domain}&subdomain=${subdomain}&dir=${dir}&ftpuser=&root_domain=${root_domain}&pass=&pass2=&go=Add+Domain");
    }

    public function delete(string $domain, string $subdomain, string $fullsubdomain)
    {
        return $this->api->raw("addon/dodeldomain.html?domain=${domain}&subdomain=${subdomain}&fullsubdomain=${fullsubdomain}");
    }
}
