<?php

namespace Akhaled\CPanelAPI\Providers;

use Akhaled\CPanelAPI\CPanelAPI;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CPanelAPIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/cpanel.php', 'cpanel'
        );

        App::bind('cpanel-api',function() {
            return new CPanelAPI;
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'cpanel-api');
    }
}
