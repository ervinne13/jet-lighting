<?php

namespace Jet\Domain\PLD\ValueObject;

class PartNumber
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        //  TODO: validation, generation of size
        $this->value = $value;
    }

    public function getStringVal() : string
    {
        return $this->value;
    }
}