<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Specification\HasMutableId;
use Jet\Domain\PLD\Entity\Item;
use Jet\Domain\PLD\Entity\StockInquiry;
use JsonSerializable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="stock_inquiry_header")
 */
class StockInquiryDetails implements JsonSerializable
{
    use Timestamps;
    use HasMutableId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="StockInquiry", inversedBy="details")
     * @ORM\JoinColumn(name="document_number", referencedColumnName="document_number")
     * @var StockInquiry
     */
    private $header;

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="item_code", referencedColumnName="code")
     * @var Item
     */
    private $item;

    /**
     * @ORM\Column(type="integer", name="needed_quantity")
     */
    private $neededQuantity;

    /**
     * @ORM\Column(type="integer", name="on__hand_quantity")
     */
    private $onHandQuantity;

    /**    
     * @ORM\OneToOne(targetEntity="Supplier")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id", nullable=false)
     * @var Supplier
     */
    private $supplier;

    /**
     * @ORM\Column(type="integer", name="supplier_quantity")
     */
    private $supplierQuantity;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2, name="supplier_unit_cost")
     */
    private $supplierUnitCost;

    public function __construct(
        Item $item,
        int $neededQuantity,
        int $onHandQuantity,
        SupplierStockCommitment $ssc = null
    ) {
        $this->item = $item;
        $this->neededQuantity = $neededQuantity;
        $this->onHandQuantity = $onHandQuantity;

        if ($ssc) {
            $this->supplier = $ssc->getSupplier();
            $this->supplierQuantity = $ssc->getQuantity();
            $this->supplierUnitCost = $ssc->getUnitCost()->getFloatVal();
        } else {
            $this->supplierQuantity = 0;
            $this->supplierUnitCost = 0;
        }
    }

    public function jsonSerialize()
    {
        return [
            'item'              => $this->item->jsonSerialize(),
            'neededQuantity'    => $this->neededQuantity,
            'onHandQuantity'    => $this->onHandQuantity,
            'supplier'          => $this->supplier,
            'supplierQuantity'  => $this->supplierQuantity,
            'supplierUnitCost'  => $this->supplierUnitCost,
        ];
    }
}