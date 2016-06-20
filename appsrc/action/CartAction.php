<?php

namespace App\Action;

use Slim\Http\Request;
use Slim\Http\Response;

class CartAction
{
    public $cartResource;

    public function __construct($cartResource)
    {
        $this->cartResource = $cartResource;
    }

    public function addItem(Request $request, Response $response, $args)
    {
        $input = $request->getParsedBody();
        $result = $this->cartResource->addItem($input['id'], $input['qty']);
        $data = [
            "status" => "success",
            "data" => $result,
        ];
        return $response->withJson($data);
    }
}
