<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;
use Akhaled\CPanelAPI\Exceptions\NoDomainGivenForSubDomain;

class Domain
{
    private $api;

    function __construct(CPanelAPI $api)
    {
        $this->api = $api;
    }

    public function create(string $domain)
    {
        return $this->api->post([
            'cpanel_jsonapi_apiversion' => "2",
            'cpanel_jsonapi_module' => "Park",
            'cpanel_jsonapi_func' => "park",
            'domain' => $domain,
        ])->getBody();
    }

    public function delete(string $domain)
    {
        // return $this->api->raw("subdomain/dodeldomain.html?domain=${subdomain}.{$this->domain}");
    }
}
