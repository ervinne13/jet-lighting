<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Company;
use Jet\Domain\Common\Entity\Specification\HasMutableId;
use Jet\Domain\PLD\Entity\ItemCategory;
use Jet\Domain\PLD\Entity\SupplierCost;
use Jet\Domain\PLD\Entity\SupplierItem;
use Jet\Infrastructure\PLD\Entity\PersistentItem;
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
     * @ORM\ManyToOne(targetEntity="ItemCategory", inversedBy="items")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @var ItemCategory
     */
    private $category;

    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", name="image_url")
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="SupplierCost", mappedBy="item", cascade={"all"})    
     */
    private $supplierCosts;

    /**
     * @ORM\OneToMany(targetEntity="ItemStockSummary", mappedBy="item")
     */
    private $stockSummaries;

    public function __construct(
        ItemCategory $category,
        string $code,
        string $name,
        string $description = null,
        array $supplierCosts = []        
    ) {
        $this->category     = $category;
        $this->code         = $code;
        $this->name         = $name;
        $this->description  = $description;

        foreach($supplierCosts as $cost) {
            $this->addSupplierCost($cost);
        }
    }

    public function getCategory() : ItemCategory
    {
        return $this->category;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getImageUrl() : string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function getSupplierCosts() : array
    {
        return $this->supplierCosts;
    }

    public function getLeastCostSupplier() : ?SupplierCost
    {
        $leastCost = null;
        foreach ($this->supplierCosts as $supplierCost) {            
            if (!$leastCost || $leastCost->getCost() > $supplierCost->getCost()) {
                $leastCost = $supplierCost;
            }
        }

        return $leastCost;
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

        $onHandQty = 0;
        if (count($this->stockSummaries) > 0) {
            $onHandQty = $this->stockSummaries[0]->getQuantity();
        }

        return [
            'category'          => $this->category,
            'code'              => $this->code,
            'name'              => $this->name,
            'description'       => $this->description,
            'supplierCosts'     => $supplierCosts,
            'leastCostSupplier' => $this->getLeastCostSupplier(),
            //  TODO: make this locaiton based
            'onHandQty'         => $onHandQty
        ];
    }    

}