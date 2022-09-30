<?php

namespace Akhaled\CPanelAPI;

use Akhaled\CPanelAPI\Modules\AddonDomain;
use Akhaled\CPanelAPI\Modules\Domain;
use Akhaled\CPanelAPI\Modules\Database;
use Akhaled\CPanelAPI\Modules\SubDomain;
use Akhaled\CPanelAPI\Modules\DatabaseUser;
use Exception;
use Illuminate\Support\Facades\Http;
use PHPHtmlParser\Dom;

class CPanelAPI
{
    public $curl;

    function __construct()
    {
        if (!is_null(config('cpanel.token'))) {
            $this->setUpAPI2();
        }
    }

    public function domain()
    {
        return new Domain($this);
    }

    public function addonDomain()
    {
        return new AddonDomain($this);
    }

    public function subdomain(string $domain = null)
    {
        return new SubDomain($this, $domain);
    }

    public function database()
    {
        return new Database($this);
    }

    public function databaseUser()
    {
        return new DatabaseUser($this);
    }

    public function raw(string $url): Dom
    {
        $cpanel = config('cpanel');

        return (new Dom())->loadStr(
            Http::get("https://$cpanel[user]:".urlencode($cpanel['password'])."@$cpanel[host]:2083/frontend/$cpanel[skin]/".$url)
                ->body()
        );
    }

    public function post(array $payload = []): array
    {
        $cpanel = config('cpanel');

        $payload = array_merge($payload, [
            'cpanel_jsonapi_apiversion' => 2,
        ]);

        $response = Http::post("https://$cpanel[user]:".urlencode($cpanel['password'])."@$cpanel[host]:2083/json-api/cpanel", $payload);

        throw_unless(isset($response['cpanelresult']), new Exception(json_encode($response)));
        throw_if(isset($response['cpanelresult']['error']), new Exception($response['cpanelresult']['error'] ?? ""));

        return $response['cpanelresult'];
    }

    private function setUpAPI2(): void
    {
        $this->curl = Http::withHeaders([
            'Authorization' => "cpanel ".config('cpanel.user').":".config('cpanel.token')
        ]);
    }
}
