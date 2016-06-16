<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

define('PROJECT_ROOT', __DIR__);
define('VENDOR', PROJECT_ROOT . '/vendor');
define('BOOTSTRAP', PROJECT_ROOT . '/bootstrap');
define('APP', PROJECT_ROOT . '/appsrc');
define('CACHE', PROJECT_ROOT . '/cache');

try {
    $entityManager = require BOOTSTRAP . '/doctrine.php';
    $platform = $entityManager->getConnection()->getDatabasePlatform();
    $platform->registerDoctrineTypeMapping('enum', 'string');
    return ConsoleRunner::createHelperSet($entityManager);
}
catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
