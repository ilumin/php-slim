<?php

namespace App\Resource;

use Doctrine\ORM\EntityManagerInterface;

class ProductResource
{
    protected $doctrine = null;
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function fetch()
    {
        $productRepository = $this->doctrine->getRepository('App\Entity\Product');
        $products = $productRepository->findAll();
        return $products;
    }
}
