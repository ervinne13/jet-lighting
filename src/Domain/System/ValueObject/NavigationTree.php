<?php

namespace Jet\Domain\System\ValueObject;

use ArrayAccess;
use Ervinne\Arrays\ArrayAccessible;
use Jet\Domain\System\ValueObject\NavigationNode;

class NavigationTree extends ArrayAccessible
{
    public function addNode(NavigationNode $node)
    {
        $this->array[] = $node;
    }    
}