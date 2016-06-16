<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    public $name;

    /**
     * @ORM\Column(type="float")
     * @var float
     */
    public $price;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @var \DateTime
     */
    protected $createdAt;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->createdAt = isset($data['createdAt']) ? $data['createdAt'] : new \Datetime();
    }
}
