<?php

namespace Jet\Infrastructure\System\Service;

use Doctrine\ORM\EntityRepository;
use Jet\Domain\System\Entity\User;
use Jet\Domain\System\Service\UserRepository;
use Jet\Domain\System\ValueObject\Username;

class UserRepositoryDoctrineImpl extends EntityRepository implements UserRepository
{
    public function findByUsername(Username $username) : User
    {
        return $this->findOneBy([
            'username' => $username->getStringValue()
        ]);
    }

    public function isRegistered(Username $username) : bool
    {
        $criteria = ['username' => $username->getStringValue()];
        return $this->count($criteria) > 0;
    }
}