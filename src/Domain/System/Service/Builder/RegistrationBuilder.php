<?php

namespace Jet\Domain\System\Service\Builder;

use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\UserRegistration;
use Jet\Domain\System\ValueObject\Credentials;
use Jet\Domain\System\ValueObject\MatchingPasswords;
use Jet\Domain\System\ValueObject\Password;
use Jet\Domain\System\ValueObject\Username;

class RegistrationBuilder
{
    private $name;
    private $username;
    private $password;
    private $role;

    public function withDisplayName(string $name)
    {
        $this->displayName = $name;
        return $this;
    }

    public function withUsername(string $username)
    {
        $this->username = new Username($username);
        return $this;
    }

    public function withPassword(string $password)
    {
        $this->password = (new Password($password))->getStringVal();
        return $this;
    }

    public function withRepeatPassword(string $repeatPassword)
    {
        $this->password = (new MatchingPasswords(
            $this->password, $repeatPassword
        ))->valildateAndGet();
        return $this;
    }

    public function withRole(Role $role)
    {
        $this->role = $role;
        return $this;
    }

    public function build() : UserRegistration
    {
        return new UserRegistration(
            new Credentials($this->username, $this->password), 
            $this->displayName,
            $this->role
        );
    }

    public function flush() : void
    {
        $this->displayName = null;
        $this->username = null;
        $this->password = null;
        $this->role = null;
    }
}