<?php

return [
    'user' => env('CPANEL_USER'),
    'password' => env('CPANEL_PASSWORD'),
    'host' => env('CPANEL_HOST'),
    'skin' => env('CPANEL_SKIN', "paper_lantern"),
    'default_dir' => env('CPANEL_DEFAULT_DOMAIN_DIR'),
];