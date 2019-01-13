<?php

namespace Jet\Domain\PLD\Service;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Jet\Domain\PLD\Entity\ItemCategory;

interface ItemCategoryRepository extends ObjectRepository, Selectable
{
    function findByName(string $name) : ItemCategory;
}