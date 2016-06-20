<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="carts")
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    public $id;

    /**
     * @ORM\Column(type="float", name="total_price")
     * @var float
     */
    public $totalPrice;

    /**
     * @ORM\Column(type="integer", name="item_count")
     * @var int
     */
    public $itemCount;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", fetch="EXTRA_LAZY")
     * @var CartItem[]
     */
    protected $cartItems;

    public function addItem($product, $qty)
    {
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
    }

    public function hasProduct($product)
    {
        $productId = $product->id;
        foreach ($this->cartItems as $id => $item) {
            if ($productId == $id) {
                return true;
            }
        }

        return false;
    }
}
