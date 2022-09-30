<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;
use Akhaled\CPanelAPI\Events\AddonDomainCreated;
use Akhaled\CPanelAPI\Events\SubDomainDeleted;

class AddonDomain
{
    private $api;

    function __construct(CPanelAPI $api)
    {
        $this->api = $api;
    }

    public function create(string $domain, string $subdomain, string $dir = null)
    {
        $dir ??= config('cpanel.default_dir', $domain);

        $this->api->post([
            'cpanel_jsonapi_module' => 'AddonDomain',
            'cpanel_jsonapi_func' => 'addaddondomain',
            'dir' => $dir,
            'newdomain' => $domain,
            'subdomain' => $subdomain,
            'ftp_is_optional' => 1,
        ]);

        event(new AddonDomainCreated($domain, $subdomain, $dir));
    }

    public function delete(string $domain, string $subdomain)
    {
        $this->api->post([
            'cpanel_jsonapi_module' => 'AddonDomain',
            'cpanel_jsonapi_func' => 'deladdondomain',
            'domain' => $domain,
            'subdomain' => $subdomain,
        ]);

        event(new SubDomainDeleted($domain, $subdomain));
    }
}
