<?php

namespace Jet\Infrastructure\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="items")
 */
class PersistentItem
{
    use Timestamps;
    
    /**
     * @ORM\Id
     * @ORM\Column(name="code", type="string")
     * @var string
     */
    protected $code;    

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="PersistentSupplierCost", mappedBy="item", cascade={"all"})    
     */
    private $supplierCosts;
}