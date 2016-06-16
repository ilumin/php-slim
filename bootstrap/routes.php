<?php

$app->get('/hello/{name}', 'SimpleCrudAction:hello');
$app->get('/products', 'SimpleCrudAction:fetch');
$app->get('/products/{id}', 'SimpleCrudAction:get');
$app->post('/products', 'SimpleCrudAction:create');
$app->put('/products/{id}', 'SimpleCrudAction:update');
