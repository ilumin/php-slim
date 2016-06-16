<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$settings = require BOOTSTRAP . '/settings.php';
$databaseConfig = $settings['doctrine'];
$doctrineConfig = Setup::createAnnotationMetadataConfiguration(
    $databaseConfig['meta']['entityPath'],
    $databaseConfig['meta']['auto_generate_proxies'],
    $databaseConfig['meta']['proxy_dir'],
    $databaseConfig['meta']['cache'],
    false
);

$entityManager = EntityManager::create($databaseConfig['connection'], $doctrineConfig);

return $entityManager;
