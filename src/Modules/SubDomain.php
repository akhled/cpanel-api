<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;
use Akhaled\CPanelAPI\Exceptions\NoDomainGivenForSubDomain;

class SubDomain
{
    private $api;
    private $domain;

    function __construct(CPanelAPI $api, string $domain = null)
    {
        $this->api = $api;
        $this->domain = $domain;
    }

    public function create(string $subdomain)
    {
        if (!$this->domain) {
            throw new NoDomainGivenForSubDomain;
        }

        return $this->api->raw("subdomain/doadddomain.html?rootdomain={$this->domain}&domain=${subdomain}&dir={$this->domain}/public&go=Create");
    }

    public function delete(string $subdomain)
    {
        if (!$this->domain) {
            throw new NoDomainGivenForSubDomain;
        }

        return $this->api->raw("subdomain/dodeldomain.html?domain=${subdomain}.{$this->domain}");
    }
}
