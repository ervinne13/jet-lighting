<?php

namespace Jet\Domain\Common\Entity\Specification;

trait HasCreatedBy
{
    /**
     * @ORM\Column(name="created_by_username", type="string")
     * @var string
     */
    protected $createdBy;

    protected function generateCreatedBy() : void
    {
        $this->createdBy = current_user()->getUsername();
    }
}