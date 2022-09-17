<?php

namespace Akhaled\CPanelAPI\Modules;

use Closure;
use Exception;
use Illuminate\Support\Arr;

abstract class Module
{
    protected $api;
    protected $module;
    protected $function;

    public function raw(array $body = [], Closure $else)
    {
        if ($this->api->curl) {
            $response = $this->api->curl
                ->post("https://".config('cpanel.host').":2083/execute/{$this->module}/{$this->function}", $body)
                ->json();

            throw_if($response['status'] != 1, new Exception(Arr::first($response['errors'])));

            return $response;
        }

        return $else($this->api);
    }
}
