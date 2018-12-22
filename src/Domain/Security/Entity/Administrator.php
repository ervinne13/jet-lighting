<?php

namespace Jet\Domain\Security\Entity;

interface Administrator extends User
{
    function createUser(UserCreation $userCreation) : User;
}