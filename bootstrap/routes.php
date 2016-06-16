<?php

$app->get('/hello/{name}', 'SimpleCrudAction:hello');
$app->get('/products', 'SimpleCrudAction:fetch');
