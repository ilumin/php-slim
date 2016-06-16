<?php

$container = $app->getContainer();

$container['doctrine'] = function ($c) {
    $entityManager = require BOOTSTRAP . '/doctrine.php';
    return $entityManager;
};

$container['SimpleCrudAction'] = function ($c) {
    $productResource = new App\Resource\ProductResource($c->get('doctrine'));
    return new App\Action\CrudAction($productResource);
};
