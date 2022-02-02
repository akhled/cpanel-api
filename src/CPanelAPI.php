<?php

namespace Akhaled\CPanelAPI;

use Akhaled\CPanelAPI\Modules\AddonDomain;
use Akhaled\CPanelAPI\Modules\Domain;
use Akhaled\CPanelAPI\Modules\Database;
use Akhaled\CPanelAPI\Modules\SubDomain;
use Akhaled\CPanelAPI\Modules\DatabaseUser;
use Illuminate\Support\Facades\Http;

class CPanelAPI
{
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

    public function raw(string $url)
    {
        $cpanel = config('cpanel');
        $url = "https://$cpanel[user]:$cpanel[password]@$cpanel[host]:2083/frontend/$cpanel[skin]/".$url;

        // $curl_path = "/usr/bin/curl";
        $curl_path = "";
        return !empty($curl_path) ? exec("$curl_path '$url'") : file_get_contents($url);
    }

    public function post(array $payload = [])
    {
        $cpanel = config('cpanel');

        return Http::post("https://$cpanel[user]:$cpanel[password]@$cpanel[host]:2083/json-api/cpanel", $payload);
    }
}
