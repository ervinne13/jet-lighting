<?php

namespace Jet\Domain\PLD\ValueObject;

class UnitOfMeasurement
{
    const FEET = 'FT';

    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        if (!in_array($value, $this->getValidValues())) {
            throw new Exception("Invalid Unit of Measurement: {$value}");
        }

        $this->value = $value;
    }

    public function getStringVal() : string
    {
        return $this->value;
    }

    public function getValidValues() : array
    {
        return [
            static::FEET
        ];
    }
}