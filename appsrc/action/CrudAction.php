<?php

namespace App\Action;

use Slim\Http\Request;
use Slim\Http\Response;

class CrudAction
{
    public $productResource;

    public function __construct($productResource)
    {
        $this->productResource = $productResource;
    }

    public function get(Request $request, Response $response, $args)
    {
        $result = $this->productResource->get();
        $data = [
            "status" => "success",
            "data" => $result,
        ];
        return $response->withJson($data);
    }

    public function hello(Request $request, Response $response, $args)
    {
        $data = [
            "status" => "success",
            "data" => "SAWADDEE JA, " . $args['name'],
        ];
        return $response->withJson($data);
    }
}
