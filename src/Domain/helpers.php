<?php

use Illuminate\Support\Facades\Auth;
use Jet\Domain\System\Entity\User;

/**
 * Wraps the implementation of the container. With this
 * we can just change this function to change which container
 * the domain models use.
 */
function container($abstract)
{
    return app($abstract);
}

function current_user() : User
{
    return Auth::user();
}