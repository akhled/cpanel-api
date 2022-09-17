<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;
use Akhaled\CPanelAPI\Events\SubDomainCreated;
use Akhaled\CPanelAPI\Events\SubDomainDeleted;
use Akhaled\CPanelAPI\Exceptions\SubDomainWasNotDeleted;
use Akhaled\CPanelAPI\Exceptions\NoDomainGivenForSubDomain;
use Akhaled\CPanelAPI\Exceptions\SubDomainWasNotCreated;
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
            SubDomainWasNotCreated::class
        );

        event(new SubDomainCreated($this->domain, $subdomain, $dir));
    }

    public function delete(string $subdomain): void
    {
        throw_if(is_null($this->domain), NoDomainGivenForSubDomain::class);

        // whm
        // https://hostname.example.com:2087/cpsess##########/json-api/delete_domain?api.version=1&domain=example.com

        $response = $this->api->raw("subdomain/dodeldomain.html?domain=${subdomain}.{$this->domain}")
            ->getElementById('deleteSuccess');

        throw_unless($response instanceof HtmlNode, SubDomainWasNotDeleted::class);

        event(new SubDomainDeleted($this->domain, $subdomain));
    }
}
