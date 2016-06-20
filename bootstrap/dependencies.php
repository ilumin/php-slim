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

$container['CartAction'] = function ($c) {
    $cartResource = new App\Resource\CartResource($c->get('doctrine'));
    return new App\Action\CartAction($cartResource);
};
