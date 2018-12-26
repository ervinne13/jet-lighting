<?php

namespace Jet\Domain\System\Entity;

use Doctrine\ORM\Mapping AS ORM;

use Illuminate\Contracts\Auth\Authenticatable as LaravelAuthenticatable;
use Jet\Domain\System\Entity\Location;
use Jet\Domain\System\Entity\Role;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use LaravelDoctrine\ORM\Auth\Authenticatable as DoctrineAuthenticatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements LaravelAuthenticatable
{
    use DoctrineAuthenticatable;
    use Timestamps;   

     /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;    

    /**
     * @ORM\OneToMany(targetEntity="UserRole", mappedBy="user")
     */
    private $userRoles;

    public function __construct(string $username, string $name)
    {
        $this->username = $username;
        $this->name = $name;
    }

    public function assignLocation(Location $location) : void
    {

    }

    public function dissociateLocation(Location $location) : void
    {

    }

    public function getUsername()
    {        
        return $this->username;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrimaryRole() : Role
    {
        foreach($this->userRoles as $userRole) {
            if ($userRole->isPrimary()) {
                return $userRole->getRole();
            }
        }

        return $this->userRoles[0];
    }

    /**
     * Get the column name for the primary key
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}