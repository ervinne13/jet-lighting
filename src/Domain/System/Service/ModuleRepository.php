<?php

namespace Jet\Domain\System\Service;

interface ModuleRepository
{
    function getAllActive() : array;
}