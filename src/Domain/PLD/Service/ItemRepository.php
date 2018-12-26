<?php

namespace Jet\Domain\PLD\Service;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Jet\Domain\PLD\Entity\Item;

interface ItemRepository extends ObjectRepository, Selectable
{
    function findByCode(string $code) : Item;
}