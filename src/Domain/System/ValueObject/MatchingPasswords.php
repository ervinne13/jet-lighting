<?php

namespace Jet\Domain\System\ValueObject;

use Jet\Domain\Common\ValueObject\TextLengthInvariant;
use Jet\Domain\System\Exception\RegistrationFailedException;
use Jet\Domain\System\ValueObject\Password;

class MatchingPasswords
{
    /** @var string */
    private $password;

    /** @var string */
    private $passwordRepeat;

    public function __construct(string $password, string $passwordRepeat)
    {
        $this->password         = $password;
        $this->passwordRepeat   = $passwordRepeat;
    }
    
    public function valildateAndGet() : Password
    {
        $formattedPassword = new Password($this->password);
        if ($this->password !== $this->passwordRepeat) {
            throw RegistrationFailedException::fromNonMatchingPasswords();
        }

        return $formattedPassword;
    }
}