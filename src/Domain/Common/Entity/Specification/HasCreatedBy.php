<?php

namespace Jet\Domain\Common\Entity\Specification;

use Jet\Domain\System\Entity\User;

trait HasCreatedBy
{
    /**
     * @ORM\Column(name="created_by_username", type="string")
     * @var string
     */
    protected $createdByUsername;

    /**
     * @ORM\ManyToOne(targetEntity="\Jet\Domain\System\Entity\User")
     * @ORM\JoinColumn(name="created_by_username", referencedColumnName="username")
     */
    private $createdBy;

    protected function generateCreatedBy() : void
    {
        $this->createdBy = current_user();
        $this->createdByUsername = $this->createdBy->getUsername();
    }

    public function getCreatedBy() : User
    {
        //  Allow nullables as users can also be deleted
        return $this->createdBy ?: $this->createdByUsername;
    }
}