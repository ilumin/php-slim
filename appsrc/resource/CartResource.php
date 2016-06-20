<?php

namespace App\Resource;

use Doctrine\ORM\EntityManagerInterface;

class CartResource
{
    protected $doctrine = null;
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getProduct($productId)
    {
        $productRepository = $this->doctrine->getRepository('App\Entity\Product');
        $product = $productRepository->findOneBy([
            'id' => $productId,
        ]);
        if (!$product) {
            throw new \Exception("Product not found");
        }

        return $product;
    }

    public function getCart() {
        $cartRepository = $this->doctrine->getRepository('App\Entity\Cart');
        $cart = $cartRepository->findOne();
        if (!$cart) {
            $cart = new Cart();
        }

        return $cart;
    }

    public function addItem($productId, $qty)
    {
        try {
            // is product exists ==> Product
            $product = $this->getProduct($productId);

            // is cart exists, if not exists --> create cart ==> Cart
            $cart = $this->getCart();

            // has this product in cart (YES) --> update qty ==> CartItem
            // has this product in cart (NO) --> insert cart item ==> CartItem
            $hasProduct = $cart->hasProduct($product);
            if ($hasProduct) {
                $item = $cart->cartItems[$product->id];
                $item->price = $product->price;
                $item->qty += $qty;
                $item->totalPrice = $item->price * $item->qty;
                $cart->cartItems[$product->id] = $item;
            }
            else {
                $cart->cartItems[$product->id] = new CartItem($product, $qty);
            }

            // update cart info
            $cart->totalPrice = 0;
            $cart->itemCount = 0;
            foreach ($cart->cartItems as $id => $item) {
                $cart->totalPrice += $item->totalPrice;
                $cart->itemCount += $item->qty;
            }

            $this->doctrine->persist($cart);
            $this->doctrine->flush();

            return $cart;
        }
        catch (\Exception $e) {
            echo "\n File: " . $e->getFile();
            echo "\n Line: " . $e->getLine();
            throw new \Exception("Cannot add item to cart (" . $e->getMessage() . ")");
        }

        return $result;
    }
}
