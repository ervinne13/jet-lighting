<?php

namespace Jet\Domain\Common\Entity\Specification;

trait HasMutableId
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     * @var string
     */
    protected $id;

    public function getId() : ?string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }
}