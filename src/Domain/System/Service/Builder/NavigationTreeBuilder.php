<?php

namespace Jet\Domain\System\Service\Builder;

use Jet\Domain\System\ValueObject\NavigationTree;

interface NavigationTreeBuilder
{
    function createFrom(array $nodes) : NavigationTree;
}