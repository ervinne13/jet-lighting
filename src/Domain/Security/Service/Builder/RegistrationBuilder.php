<?php

namespace Jet\Domain\Security\Service\Builder;

use Jet\Domain\Security\Registration;
use Jet\Domain\Security\ValueObject\Credentials;
use Jet\Domain\Security\ValueObject\MatchingPasswords;
use Jet\Domain\Security\ValueObject\Password;
use Jet\Domain\Security\ValueObject\Username;

class RegistrationBuilder
{
    private $displayName;
    private $username;
    private $password;

    public function withDisplayName(string $displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    public function withUsername(string $username)
    {
        $this->username = new Username($username);
        return $this;
    }

    public function withPassword(string $password)
    {
        $this->password = (new Password($password))->getStringValue();
        return $this;
    }

    public function withRepeatPassword(string $repeatPassword)
    {
        $this->password = (new MatchingPasswords(
            $this->password, $repeatPassword
        ))->valildateAndGet();
        return $this;
    }

    public function build() : Registration
    {
        return new Registration(
            new Credentials($this->username, $this->password), 
            $this->displayName
        );
    }
}