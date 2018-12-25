<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Company;
use Jet\Domain\Common\Entity\Specification\HasMutableId;
use Jet\Domain\PLD\Entity\SupplierItem;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="items")
 */
class Item
{
    use Timestamps;
    use HasMutableId;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="part_number", nullable=true)
     */
    private $partNumber;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="SupplierCost", mappedBy="item", cascade={"all"})
     * @var SupplierCost
     */
    private $supplierCosts;

    public function __construct(
        string $name,
        string $description = null,
        array $supplierCosts = [],
        PartNumber $partNumber = null,
        Size $size = null
    ) {
        $this->name         = $name;
        $this->description  = $description;        

        if ($partNumber) {
            $this->partNumber = $partNumber->getStringVal();
        }

        if ($size) {
            $this->size = $size->getStringVal();
        }

        foreach($supplierCosts as $cost) {
            $this->addSupplierCost($cost);
        }
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function getPartNumber() : ?string
    {
        return $this->partNumber;
    }

    public function getSize() : ?string
    {
        return $this->size;
    }

    public function getSupplierCosts() : array
    {
        return $this->supplierCosts;
    }

    private function addSupplierCost(SupplierCost $cost)
    {
        $this->supplierCosts[] = $cost->setItem($this);
    }
}