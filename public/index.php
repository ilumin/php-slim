<?php

define('PROJECT_ROOT', __DIR__ . '/..');
define('VENDOR', PROJECT_ROOT . '/vendor');
define('BOOTSTRAP', PROJECT_ROOT . '/bootstrap');
define('APP', PROJECT_ROOT . '/appsrc');
define('CACHE', PROJECT_ROOT . '/cache');

require VENDOR . '/autoload.php';

$settings = require BOOTSTRAP . '/settings.php';
$app = new \Slim\App($settings);

require BOOTSTRAP . '/dependencies.php';
require BOOTSTRAP . '/routes.php';

$app->run();
