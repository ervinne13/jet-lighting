<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\ValueObject\Amount;
use Jet\Domain\PLD\Entity\Item;
use Jet\Domain\PLD\Entity\Supplier;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="supplier_item_costs")
 */
class SupplierCost
{
    use Timestamps;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="items")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     * @var Supplier
     */
    private $supplier;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="supplierCosts")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")    
     * @var Item
     */
    private $item; 

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2, name="last_purchased_unit_cost")
     */
    private $lastPurchasedUnitCost;

    public function __construct(Supplier $supplier, Amount $lastPurchasedUnitCost)
    {
        $this->supplier = $supplier;
        $this->lastPurchasedUnitCost = $lastPurchasedUnitCost->getFloatVal();
    }

    public function getItem() : Item
    {
        return $this->item;
    }

    public function setItem(Item $item)
    {
        $this->item = $item;

        return $this;
    }

    public function getLastPurchasedUnitCost() : float
    {
        return $this->lastPurchasedUnitCost;
    }

    public function getSupplier() : Supplier
    {
        return $this->supplier;
    }

}