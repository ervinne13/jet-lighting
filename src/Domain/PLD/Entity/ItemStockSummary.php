<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\PLD\Entity\Item;
use Jet\Infrastructure\PLD\Entity\PersistentItemStockSummary;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_stock_summaries")
 */
class ItemStockSummary
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="stockSummaries")
     * @ORM\JoinColumn(name="item_code", referencedColumnName="code")
     * @var Item
     */
    protected $item;

    /**
     * @ORM\Column(type="integer", name="quantity")
     */
    protected $quantity;

    public function __construct(Item $item, int $quantity)
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }

    public function getItem() : Item
    {
        return $this->item;
    }

    public function getQuantity() : int
    {
        return $this->quantity;
    }
}