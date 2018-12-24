<?php

namespace Jet\Domain\System\Entity;

use Doctrine\ORM\Mapping AS ORM;

use Illuminate\Contracts\Auth\Authenticatable as LaravelAuthenticatable;
use Jet\Domain\System\Entity\Location;
use LaravelDoctrine\ORM\Auth\Authenticatable as DoctrineAuthenticatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Module
{    

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @ORM\Column(type="string")
     */
    private $name;    

    /**
     * Cannot be instantiated.
     * Creation of new users must go through UserRegistration model.
     */
    private function __construct()
    {
        //  cannot be instantiated
    }

    function assignLocation(Location $location) : void
    {

    }

    function dissociateLocation(Location $location) : void
    {

    }

    function getUsername() : string
    {
        return $this->username;
    }

    function getName() : string
    {
        return $this->displayName;
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