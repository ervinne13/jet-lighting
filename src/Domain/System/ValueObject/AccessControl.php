<?php

namespace Jet\Domain\System\ValueObject;

use Exception;

class AccessControl
{
    const VIEWER    = 'viewer';
    const AUTHOR    = 'author';
    const MANAGER   = 'manager';

    /** @var string */
    private $type;

    public function __construct(string $type)
    {
        if (!in_array($type, $this->getValidTypes())) {
            throw new Exception("Access Control {$type} is invalid");
        }

        $this->type = $type;
    }

    public function getStringVal() : string
    {
        return $type;
    }

    private function getValidTypes() : array
    {
        return [
            static::VIEWER,
            static::AUTHOR,
            static::MANAGER,
        ];
    }

}