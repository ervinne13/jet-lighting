<?php

namespace Jet\Domain\Common\ValueObject;

class Amount
{
    /** @var float */
    private $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function getFloatVal() : float
    {
        return $this->value;
    }
}