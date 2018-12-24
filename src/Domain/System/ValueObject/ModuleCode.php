<?php

namespace Jet\Domain\System\ValueObject;

/**
 * Immutable value object representing the module code
 */
class ModuleCode
{
    /** @var string */
    private $code;

    /** @var int */
    private $maxLength = 10;

    public function __construct(string $code)
    {
        if (strlen($code) > $this->maxLength) {
            throw new Exception("Module code must not exceed {$this->maxLength} characters.");
        }

        $this->code = strtoupper($code);
    }

    public function getStringValue()
    {
        return $this->code;
    }
}