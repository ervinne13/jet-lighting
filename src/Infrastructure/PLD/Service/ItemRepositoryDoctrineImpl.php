<?php

namespace Jet\Infrastructure\System\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\PLD\Entity\Item;
use Jet\Domain\PLD\Service\ItemRepository;

class ItemRepositoryDoctrineImpl extends EntityRepository implements ItemRepository
{
    public function findByCode(string $code) : Item
    {
        $criteria = ['code' => $code];
        return $this->findOneBy($criteria);
    }
}