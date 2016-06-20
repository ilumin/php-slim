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
    protected $cartItems;

    public function __construct()
    {
        $this->totalPrice = 0;
        $this->itemCount = 0;
        $this->cartItems = new ArrayCollection();
        $this->createdAt = new \Datetime();
    }

    public function addItem($product, $qty)
    {
        $cartItem = $this->getItemByProduct($product);

        if ($cartItem) {
            $cartItem->price = $product->price;
            $cartItem->qty += $qty;
            $cartItem->totalPrice = $cartItem->price * $cartItem->qty;
        }
        else {
            $cartItem = new CartItem($product, $qty, $this);
            $this->cartItems->add($cartItem);
        }

        $this->updateInfo();
    }

    public function getItemByProduct($product)
    {
        /** @var ArrayCollection $cartItems */
        $cartItems = $this->cartItems->filter(function($cartItem) use ($product) {
            return $cartItem->getProductId() == $product->id;
        });
        return $cartItems->first();
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

    public function getData()
    {
        $result = [];
        $result['total_price'] = $this->totalPrice;
        $result['item_count'] = $this->itemCount;
        $result['items'] = [];

        foreach ($this->cartItems as $id => $item) {
            $product = $item->getProduct();
            $result['items'][] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $item->price,
                'total_price' => $item->totalPrice,
                'qty' => $item->qty,
            ];
        }

        return $result;
    }
}
