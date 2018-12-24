<?php

namespace Jet\Domain\System\ValueObject;

interface NavigationNodesParent
{
    function addChild(NavigationNode $node);

    function addChildren(array $nodes);

    function getChildren() : array;
}