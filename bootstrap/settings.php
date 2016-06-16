<?php

// Display error on development environment
error_reporting(E_ALL);
ini_set('display_errors', 'on');

// Disable opcache on development environment
ini_set('opcache.enable', '0');

return [
    'settings' => [
        'displayErrorDetails' => true,
    ],

    'doctrine' => [
        'meta' => [
            'entityPath' => [
                APP . '/entity',
            ],
            'auto_generate_proxies' => true,
            'proxy_dir' => CACHE . '/proxies',
            'cache' => null,
        ],
        'connection' => [
            'driver'     => 'pdo_mysql',
            'host'       => 'app-database-service',
            'dbname'     => 'app',
            'user'       => 'app',
            'password'   => 'app',
        ],
    ],
];
