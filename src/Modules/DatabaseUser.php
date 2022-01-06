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

    public function create(string $name, string $password)
    {
        return $this->api->raw("sql/adduser.html?user={$name}&pass={$password}");
    }

    public function delete(string $name)
    {
        return $this->api->raw("sql/deluser.html?user=${name}");
    }

    public function addToDatabase(string $name, string $db, string $privileges = "ALL")
    {
        return $this->api->raw("sql/addusertodb.html?user={$name}&db={$db}&privileges={$privileges}");
    }
}
