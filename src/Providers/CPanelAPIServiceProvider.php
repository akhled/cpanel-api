<?php

namespace Akhaled\CPanelAPI\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Akhaled\CPanelAPI\Facades\CPanelAPI;

class CPanelAPIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/cpanel.php', 'cpanel'
        );

        App::bind('test',function() {
            return new CPanelAPI;
        });
    }

    public function boot()
    {
        //
    }
}
