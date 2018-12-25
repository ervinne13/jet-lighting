<?php

namespace Jet\Domain\System\Service;

use Jet\Domain\System\ValueObject\NavigationTree;

interface NavigationTreeNodeRemover
{
    /**
     * @param NavigationTree $sourceTree 
     *  The original NavigationTree that needs nodes to be removed
     *  based on a certain factor
     */
    function removeFrom(NavigationTree $sourceTree) : NavigationTreeNodeRemover;

    /**
     * @param mixed $factor
     *  The factor that can determine how the nodes of a NavigationTree
     *  can be removed.
     */
    function using($factor) : NavigationTreeNodeRemover;

    /**
     * Setting the original/source NavigationTree and the removal
     * factor must be done before trying to get the resulting tree.
     * 
     * @return NavigationTree
     *  The new NavigationTree object that has nodes removed.
     */
    function getResultingTree() : NavigationTree;
}