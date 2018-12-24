<?php

namespace Jet\Domain\System;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\System\Entity\User;
use Jet\Domain\System\Exception\RegistrationFailedException;
use Jet\Domain\System\Service\UserRepository;
use Jet\Domain\System\ValueObject\Credentials;
use Jet\Domain\System\ValueObject\Username;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class UserRegistration
{
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
     * @var boolean
     */
    private $validatesUserExistence = true;

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(Credentials $credentials, string $name)
    {
        $this->username = $credentials->getUsername()->getStringValue();
        $this->password = $credentials->getPassword()->getHashed();        
        $this->name = $name;
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

        $model = $this->save();
        $user  = $this->buildUser();
        
        return $user;
    }

    private function validateUserExistence()
    {        
        $existingUser = $this->repository->isRegistered(new Username($this->username));
        if ($existingUser) {
            throw RegistrationFailedException::fromAlreadyExistingUsername($this->username);
        }
    }

    private function save()
    {
        EntityManager::persist($this);
        EntityManager::flush();
    }

    private function buildUser() : User
    {
        return $this->repository->findByUsername(new Username($this->username));
    }
}