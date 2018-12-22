<?php

namespace Jet\Domain\Security;

use Jet\Domain\Security\Exception\RegistrationFailedException;
use Jet\Domain\Security\ValueObject\Credentials;
use Jet\Infrastructure\Security\UserModel;

/**
 * An Intent to register a user.
 * Eloquent based implementation of Registration Use Case.
 */
class Registration
{
    /** @var Credentials */
    private $credentials;

    /** @var string */
    private $displayName;

    private $validatesUserExistence = true;

    public function __construct(Credentials $credentials, string $displayName)
    {
        $this->credentials = $credentials;
        $this->displayName = $displayName;
    }

    /**
     * Let laravel optionally remove validation here if existence is
     * already validated in the form request.
     */
    public function bypassUsernameExistenceChecking()
    {
        $this->validatesUserExistence = false;
    }

    public function execute()
    {
        if ($this->validatesUserExistence) {
            $this->validateUserExistence();
        }

        $user = new UserModel();
        $user->username = $this->credentials->getUsername()->getStringValue();
        $user->password = $this->credentials->getPassword()->getHashed();
        $user->display_name = $this->displayName;

        $user->save();
    }

    private function validateUserExistence()
    {
        $username = $this->credentials->getUsername()->getStringValue();
        $existingUser = UserModel::find($username);
        if ($existingUser) {
            throw RegistrationFailedException::fromAlreadyExistingUsername($this->credentials->getUsername());
        }
    }
}