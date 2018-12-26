<?php

namespace Jet\Infrastructure\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_stock_summaries")
 */
class PersistentItemStockSummary
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PersistentItem")
     * @ORM\JoinColumn(name="item_code", referencedColumnName="code")
     * @var Item
     */
    protected $item;

    /**
     * @ORM\Column(type="integer", name="quantity")
     */
    protected $quantity;
    
}