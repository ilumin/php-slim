<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cart_items")
 */
class CartItem
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
     * @ORM\Column(type="float", name="price")
     * @var float
     */
    public $price;

    /**
     * @ORM\Column(type="integer", name="qty")
     * @var int
     */
    public $qty;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="cartItems")
     * @var Cart
     */
    protected $cart;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @var Product
     */
    protected $product;

    public function __construct($product, $qty, $cart)
    {
        $this->product = $product;
        $this->qty = $qty;
        $this->price = $product->price;
        $this->totalPrice = $this->price * $this->qty;
        $this->cart = $cart;
        $this->createdAt = new \Datetime();
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getProductId()
    {
        return $this->product->id;
    }
}
