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
    public function get($id)
    {
        $productRepository = $this->doctrine->getRepository('App\Entity\Product');
        $product = $productRepository->findOneBy([
            "id" => $id,
        ]);
        return $product;
    }
    public function create($data)
    {
        $this->doctrine->getConnection()->beginTransaction();
        try {
            $product = new \App\Entity\Product($data);
            $this->doctrine->persist($product);
            $this->doctrine->flush();
            $this->doctrine->getConnection()->commit();
            return $product;
        }
        catch (\Exception $e) {
            $this->doctrine->getConnection()->rollBack();
            throw new \Exception('Insert product fail with (' . $e->getMessage() . ')');
        }
    }

    public function update($id, $data)
    {
        $this->doctrine->getConnection()->beginTransaction();

        try {
            $productRepository = $this->doctrine->getRepository('App\Entity\Product');
            $product = $productRepository->findOneBy([
                'id' => $id,
            ]);
            if (!$product) {
                throw new \Exception('Product not exist');
            }
            $product->name = $data['name'];
            $product->price = $data['price'];
            $this->doctrine->persist($product);
            $this->doctrine->flush();
            $this->doctrine->getConnection()->commit();
            return $product;
        }
        catch (\Exception $e) {
            $this->doctrine->getConnection()->rollBack();
            throw new \Exception('Update product fail with (' . $e->getMessage() . ')');
        }
    }
}
