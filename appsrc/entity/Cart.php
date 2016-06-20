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
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", cascade="persist")
     * @var CartItem[]
     */
    protected $cartItems = array();

    public function __construct()
    {
        $this->totalPrice = 0;
        $this->itemCount = 0;
        $this->createdAt = new \Datetime();
    }

    public function addItem($product, $qty)
    {
        $hasProduct = $this->hasProduct($product);

        if ($hasProduct) {
            $item = $this->cartItems[$product->id];
            $item->price = $product->price;
            $item->qty += $qty;
            $item->totalPrice = $item->price * $item->qty;

            $this->cartItems[$product->id] = $item;
        }
        else {
            $this->cartItems[$product->id] = new CartItem($product, $qty);
        }

        $this->updateInfo();
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

    public function updateInfo()
    {
        $this->totalPrice = 0;
        $this->itemCount = 0;
        foreach ($this->cartItems as $id => $item) {
            $this->totalPrice += $item->totalPrice;
            $this->itemCount += $item->qty;
        }
    }
}
