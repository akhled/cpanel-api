<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;
use Akhaled\CPanelAPI\Events\SubDomainCreated;
use Akhaled\CPanelAPI\Events\SubDomainDeleted;
use Akhaled\CPanelAPI\Exceptions\NoDomainGivenForSubDomain;
use Akhaled\CPanelAPI\Exceptions\SubDomainWasNotCreated;
use PHPHtmlParser\Dom\Node\HtmlNode;
use Illuminate\Support\Facades\Http;

class SubDomain extends Module
{
    protected $module = 'SubDomain';
    private $domain;

    function __construct(CPanelAPI $api, string $domain = null)
    {
        $this->api = $api;
        $this->domain = $domain;
    }

    public function list(string $search = null): array
    {
        $payload = [
            'cpanel_jsonapi_module' => 'SubDomain',
            'cpanel_jsonapi_func' => 'listsubdomains',
            'return_https_redirect_status' => 1
        ];

        if (!is_null($search)) {
            $payload['regex'] = 'username_example.com';
        }

        return $this->api->post($payload)['data'] ?? [];
    }

    public function create(string $subdomain, string $dir = null): void
    {
        throw_if(is_null($this->domain), NoDomainGivenForSubDomain::class);

        $dir ??= config('cpanel.default_dir')."$dir/{$subdomain}.{$this->domain}";
        $this->function = 'addsubdomain';
        $cpanel = config('cpanel');

        $payload = [
            'api.version' => 1,
            'domain' => "{$subdomain}.{$this->domain}",
            'document_root' => $dir
        ];

        $response = Http::withHeaders([
            'Authorization' => "whm ".config('cpanel.user').":".config('cpanel.token')
        ])->withOptions([
            'verify' => false,
        ])->get("{$cpanel['host']}/json-api/create_subdomain?".http_build_query($payload));

        $data = $response->json();

        throw_unless(
            is_array($data) && \Arr::get($data, 'metadata.result') == 1,
            SubDomainWasNotCreated::class,
            $response->body()
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
