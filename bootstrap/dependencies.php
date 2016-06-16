<?php

$container = $app->getContainer();

$container['SimpleCrudAction'] = function ($c) {
    return new App\Action\CrudAction();
};
