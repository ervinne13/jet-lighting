<?php

namespace Jet\Domain\System;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_roles")
 */
class UserRegistrationRole
{
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="UserRegistration", inversedBy="userRoles")
     * @ORM\JoinColumn(name="username", referencedColumnName="username")
     * @var User
     */
    private $user;    

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\Jet\Domain\System\Entity\Role", inversedBy="accessControlList")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * @var Role
     */
    private $role;

    /**
     * @ORM\Column(type="boolean", name="is_primary")
     */
    private $isPrimary;

    public function __construct(Role $role,  UserRegistration $user, bool $isPrimary)
    {        
        $this->role = $role;        
        $this->user = $user;
        $this->isPrimary = $isPrimary;
    }
}