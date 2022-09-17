<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;
use Akhaled\CPanelAPI\Events\SubDomainCreated;
use Akhaled\CPanelAPI\Exceptions\SubDomainDidNotCreated;
use Akhaled\CPanelAPI\Exceptions\NoDomainGivenForSubDomain;
use Illuminate\Support\Facades\Http;
use PHPHtmlParser\Dom\Node\HtmlNode;

class SubDomain extends Module
{
    protected $module = 'SubDomain';
    private $domain;

    function __construct(CPanelAPI $api, string $domain = null)
    {
        $this->api = $api;
        $this->domain = $domain;
    }

    public function create(string $subdomain, string $dir = null): void
    {
        throw_if(is_null($this->domain), NoDomainGivenForSubDomain::class);

        $dir ??= $this->domain;
        $this->function = 'addsubdomain';

        $response = $this->raw([
            'rootdomain' => $this->domain,
            'domain' => $subdomain,
            'dir' => $dir,
        ], function(CPanelAPI $api) use ($subdomain) {
            return $api->raw("subdomain/doadddomain.html?rootdomain={$this->domain}&domain=${subdomain}&dir={$this->domain}/public&go=Create")
                ->getElementById('#addSuccess');
        });

        throw_unless(
            (is_array($response) && $response['status'] == 1) || $response instanceof HtmlNode,
            SubDomainDidNotCreated::class
        );

        event(new SubDomainCreated($this->domain, $subdomain, $dir));
    }

    public function delete(string $subdomain)
    {
        if (!$this->domain) {
            throw new NoDomainGivenForSubDomain;
        }

        $cpanel = config('cpanel');

        // https://hostname.example.com:2087/cpsess##########/json-api/delete_domain?api.version=1&domain=example.com

        // return Http::withBasicAuth($cpanel['user'], $cpanel['password'])
        //     ->get("https://$cpanel[host]:2087/cpsess8258417469/json-api/delete_domain", [
        //         'api.version' => 1,
        //         'domain' => "${subdomain}.{$this->domain}"
        //     ]);

        return $this->api->raw("subdomain/dodeldomain.html?domain=${subdomain}.{$this->domain}");
    }
}
