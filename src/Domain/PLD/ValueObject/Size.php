<?php

namespace Jet\Domain\PLD\ValueObject;

use Jet\Domain\PLD\ValueObject\UnitOfMeasurement;

class Size
{
    /** @var float */
    private $units;

    /** @var UnitOfMeasurement */
    private $uom;

    public function __construct(float $units, UnitOfMeasurement $uom)
    {
        $this->units = $units;
        $this->uom = $uom;
    }

    public static function createFromString(string $size) : Size
    {
        //  TODO
    }

    public function getStringVal() : string
    {
        return "{$this->units}{$this->uom->getStringVal()}";
    }
}