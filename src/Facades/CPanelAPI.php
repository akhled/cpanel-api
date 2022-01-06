<?php

namespace Akhaled\CPanelAPI\Facades;

use Illuminate\Support\Facades\Facade;

class CPanelAPI extends Facade
{
    protected static function getFacadeAccessor() {
        return 'cpanel-api';
    }
}