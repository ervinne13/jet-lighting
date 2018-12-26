<?php

namespace Jet\Domain\PLD\ValueObject;

use Jet\Domain\Common\ValueObject\Amount;
use Jet\Domain\PLD\Entity\Supplier;

class SupplierStockCommitment
{
    /**
     * @var Supplier
     */
    private $supplier;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var Amount
     */
    private $unitCost;

    public function __construct(Supplier $supplier, int $quantity, Amount $unitCost)
    {
        $this->supplier = $supplier;
        $this->quantity = $quantity;
        $this->unitCost = $unitCost;
    }

    public function getSupplier() : Supplier
    {
        return $this->supplier;
    }

    public function getQuantity() : int
    {
        return $this->quantity;
    }

    public function getUnitCost() : Amount
    {
        return $this->unitCost;
    }
}