<?php

namespace Akhaled\CPanelAPI\Modules;

use Akhaled\CPanelAPI\CPanelAPI;

class DatabaseUser
{
    private $api;

    function __construct(CPanelAPI $api)
    {
        $this->api = $api;
    }

    public function delete(string $name)
    {
        return $this->api->raw("sql/deluser.html?user=${name}");
    }
}
