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

    public function fetch(Request $request, Response $response, $args)
    {
        $result = $this->productResource->fetch();
        $data = [
            "status" => "success",
            "data" => $result,
        ];
        return $response->withJson($data);
    }

    public function get(Request $request, Response $response, $args)
    {
        $result = $this->productResource->get($args['id']);
        $data = [
            "status" => "success",
            "data" => $result,
        ];
        return $response->withJson($data);
    }

    public function create(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $result = $this->productResource->create($data);
        $data = [
            "status" => "success",
            "data" => $result,
        ];
        return $response->withJson($data);
    }

    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $result = $this->productResource->update($args['id'], $data);
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
