<?php

namespace Jet\Domain\System\Entity;

use Doctrine\ORM\Mapping AS ORM;

use Illuminate\Contracts\Auth\Authenticatable as LaravelAuthenticatable;
use Jet\Domain\System\ValueObject\ModuleCode;
use JsonSerializable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use LaravelDoctrine\ORM\Auth\Authenticatable as DoctrineAuthenticatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="modules")
 */
class Module implements JsonSerializable
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    public function __construct(ModuleCode $code, string $name)
    {
        $this->code = $code->getStringVal();
        $this->name = $name;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return [
            'code' => $this->getCode(),
            'name' => $this->getName()
        ];
    }
}