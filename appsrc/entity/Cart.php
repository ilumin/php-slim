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
     * @ORM\Column(type="int", name="item_count")
     * @var float
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
}
