<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;

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
