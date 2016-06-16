<?php

namespace App\Action;

use Slim\Http\Request;
use Slim\Http\Response;

class CrudAction
{
    public function hello(Request $request, Response $response, $args)
    {
        $data = [
            "status" => "success",
            "data" => "SAWADDEE JA, " . $args['name'],
        ];
        return $response->withJson($data);
    }
}
