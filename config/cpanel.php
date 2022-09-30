<?php

return [
    'user' => env('CPANEL_USER'),
    'password' => env('CPANEL_PASSWORD'),
    'token' => env('CPANEL_TOKEN'),
    'host' => env('CPANEL_HOST'),
    'domain' => env('CPANEL_DOMAIN'),
    'skin' => env('CPANEL_SKIN', "paper_lantern"),
    'default_dir' => env('CPANEL_DEFAULT_DOMAIN_DIR'),
    'notifiable_email' => env('ADMIN_EMAIL'),
    'notifiable_name' => env('ADMIN_NAME', env('ADMIN_EMAIL')),
];
