<?php

namespace Jet\Domain\System;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\Entity\User;
use Jet\Domain\System\Entity\UserRole;
use Jet\Domain\System\Exception\RegistrationFailedException;
use Jet\Domain\System\Service\UserRepository;
use Jet\Domain\System\UserRegistrationRole;
use Jet\Domain\System\ValueObject\Credentials;
use Jet\Domain\System\ValueObject\Username;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * TODO: Move doctrine implementations to the infrastructure.
 * 
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class UserRegistration
{
    use Timestamps;

    /** @var Credentials */
    private $credentials;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $username;
    
    /**
     * @ORM\Column(type="string")     
     */
    private $password;

    /**
     * @ORM\Column(type="string")     
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="UserRegistrationRole", mappedBy="user", cascade={"persist"})
     */
    private $userRoles;

    /**
     * @var boolean
     */
    private $validatesUserExistence = true;

    /**
     * @var User
     */
    private $generatedUser;

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(Credentials $credentials, string $name, Role $role)
    {
        $this->username = $credentials->getUsername()->getStringVal();
        $this->password = $credentials->getPassword()->getHashed();        
        $this->name = $name;

        $this->userRoles = [new UserRegistrationRole($role, $this, true)];
    }

    /**
     * Let laravel optionally remove validation here if existence is
     * already validated in the form request.
     */
    public function bypassUsernameExistenceCheckingOnExecute()
    {
        $this->validatesUserExistence = false;
    }

    public function execute() : User
    {
        $this->repository = container(UserRepository::class);

        if ($this->validatesUserExistence) {
            $this->validateUserExistence();
        }

        $this->save();
        $this->buildUser();
        return $this->generatedUser;
    }

    private function validateUserExistence()
    {        
        $existingUser = $this->repository->isRegistered(new Username($this->username));
        if ($existingUser) {
            throw RegistrationFailedException::fromAlreadyExistingUsername($this->username);
        }
    }

    private function save() : void
    {
        EntityManager::persist($this);
        EntityManager::flush();
    }

    private function buildUser() : void
    {
        $this->generatedUser = $this->repository->findByUsername(new Username($this->username));
    }
}