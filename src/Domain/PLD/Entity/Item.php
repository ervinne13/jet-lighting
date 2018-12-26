<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Company;
use Jet\Domain\Common\Entity\Specification\HasMutableId;
use Jet\Domain\PLD\Entity\SupplierItem;
use JsonSerializable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="items")
 */
class Item implements JsonSerializable
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
     * @ORM\OneToMany(targetEntity="SupplierCost", mappedBy="item", cascade={"all"})    
     */
    private $supplierCosts;

    public function __construct(
        string $code,
        string $name,
        string $description = null,
        array $supplierCosts = [],
        Size $size = null
    ) {
        $this->code         = $code;
        $this->name         = $name;
        $this->description  = $description;

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

    public function getSupplierCosts() : array
    {
        return $this->supplierCosts;
    }

    private function addSupplierCost(SupplierCost $cost)
    {
        $this->supplierCosts[] = $cost->setItem($this);
    }

    public function getCode() : ?string
    {
        return $this->code;
    }

    public function jsonSerialize()
    {
        $supplierCosts = [];
        foreach ($this->supplierCosts as $cost) {
            $supplierCosts[] = $cost->jsonSerialize();
        }

        return [
            'code'          => $this->code,
            'name'          => $this->name,
            'description'   => $this->description,
            'supplierCosts' => $supplierCosts,
        ];
    }
}