<?php

namespace Akhaled\CPanelAPI;

use Akhaled\CPanelAPI\Modules\Database;
use Akhaled\CPanelAPI\Modules\DatabaseUser;
use Akhaled\CPanelAPI\Modules\SubDomain;

class CPanelAPI
{
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
}
