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
     * @ORM\Column(type="int", name="qty")
     * @var float
     */
    public $qty;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @var \DateTime
     */
    protected $createdAt;
}
