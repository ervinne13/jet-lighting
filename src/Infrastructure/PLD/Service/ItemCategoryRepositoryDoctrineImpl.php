<?php

namespace Jet\Infrastructure\PLD\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\PLD\Entity\ItemCategory;
use Jet\Domain\PLD\Service\ItemCategoryRepository;

class ItemCategoryRepositoryDoctrineImpl extends EntityRepository implements ItemCategoryRepository
{
    public function findByName(string $name) : ItemCategory
    {
        $criteria = ['name' => $name];
        return $this->findOneBy($criteria);
    }
}