<?php

namespace Jet\Domain\System\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\Entity\User;


/**
 * @ORM\Entity
 * @ORM\Table(name="user_roles")
 */
class UserRole
{
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userRole")
     * @ORM\JoinColumn(name="username", referencedColumnName="username")
     * @var User
     */
    private $user;    

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="accessControlList")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * @var Role
     */
    private $role;

    /**
     * @ORM\Column(type="boolean", name="is_primary")
     */
    private $isPrimary;

    public function __construct(Role $role, bool $isPrimary, User $user = null)
    {        
        $this->role = $role;
        $this->isPrimary = $isPrimary;
        $this->user = $user;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function isPrimary() : bool
    {
        return $this->isPrimary;
    }

    public function getUser() : ?User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}