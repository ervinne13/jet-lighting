<?php

namespace Jet\Domain\System\ValueObject;

use ArrayAccess;
use Ervinne\Arrays\ArrayAccessible;
use Jet\Domain\System\ValueObject\NavigationNode;
use Jet\Domain\System\ValueObject\NavigationNodesParent;

class NavigationTree implements NavigationNodesParent
{
    /** @var array */
    protected $children;

    public function __construct(array $nodes = [])
    {
        $this->children = [];
        $this->addChildren($nodes);
    }

    public function addChild(NavigationNode $node)
    {
        $this->children[] = $node;
        return $this;
    }

    public function addChildren(array $nodes)
    {
        foreach($nodes as $node) {
            $this->addChild($node);
        }
        return $this;
    }

    public function getChildren() : array
    {
        return $this->children;
    }
}