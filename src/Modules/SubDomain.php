<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;
use Akhaled\CPanelAPI\Events\SubDomainCreated;
use Akhaled\CPanelAPI\Events\SubDomainDeleted;
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

        $dir ??= config('cpanel.default_dir', $this->domain);
        $this->function = 'addsubdomain';

        $response = $this->raw([
            'rootdomain' => $this->domain,
            'domain' => $subdomain,
            'dir' => $dir,
        ], function(CPanelAPI $api) use ($subdomain, $dir) {
            return $api->raw("subdomain/doadddomain.html?rootdomain={$this->domain}&domain=${subdomain}&dir={$dir}&go=Create")
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

        $this->api->post([
            'cpanel_jsonapi_module' => "SubDomain",
            'cpanel_jsonapi_func' => "delsubdomain",
            'domain' => "${subdomain}.{$this->domain}",
        ]);

        event(new SubDomainDeleted($this->domain, $subdomain));
    }
}
