<?php

namespace Jet\Domain\System\Service;

use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\ValueObject\ModuleCode;
use Jet\Domain\System\ValueObject\NavigationNode;
use Jet\Domain\System\ValueObject\NavigationNodesParent;
use Jet\Domain\System\ValueObject\NavigationTree;

class NavigationTreeNodeRemoverUsingMissingModuleImpl implements NavigationTreeNodeRemover
{
    /** @var NavigationTree */
    private $sourceTree;
    
    /** @var NavigationTree */
    private $resultingTree;

    /** @var array[string] */
    private $factor;

    public function __construct()
    {
        $this->factor = [];
        $this->resultingTree = new NavigationTree();
    }

    public function removeFrom(NavigationTree $sourceTree) : NavigationTreeNodeRemover
    {
        $this->sourceTree = $sourceTree;
        return $this;
    }

    public function using($factor) : NavigationTreeNodeRemover
    {    
        foreach($factor as $module) {
            $this->factor[] = $this->getModuleCode($module);
        }
        
        return $this;
    }

    /**
     * Factor Invariant, makes sure that the factor elements
     * consist of Module objects
     */
    private function getModuleCode(Module $module) : string
    {
        return $module->getCode();
    }

    public function getResultingTree() : NavigationTree
    {
        $nodes = $this->recursivelyAddVisibleNodesUsing($this->sourceTree);
        return new NavigationTree($nodes);
    }

    private function recursivelyAddVisibleNodesUsing(NavigationNodesParent $nodeParent) : array
    {
        $visibleNodes = [];
        foreach($nodeParent->getChildren() as $node) {
            $visibleChildNodes = $this->recursivelyAddVisibleNodesUsing($node);

            if ($node->isMerelyAContainer() && count($visibleChildNodes) <= 0) {
                continue;
            }

            $passingNode = null;
            if ($node->isMerelyAContainer()) {
                $passingNode = $this->makeContainerOnlyNode($node, $visibleChildNodes);
            } else if ($this->passesFactor($node)) {
                $passingNode = $this->makeModuleBoundNode($node, $visibleChildNodes);
            }
            
            if ($passingNode) {
                $visibleNodes[] = $passingNode;
            }            
        }

        return $visibleNodes;
    }

    private function makeContainerOnlyNode(NavigationNode $originalNode, array $children) : NavigationNode
    {
        $node = new NavigationNode(
            $originalNode->getIconClass(),
            $originalNode->getText()
        );

        $node->addChildren($children);

        return $node;
    }

    private function makeModuleBoundNode(NavigationNode $originalNode, array $children) : NavigationNode
    {
        $node = new NavigationNode(
            $originalNode->getIconClass(),
            $originalNode->getText(),
            new ModuleCode($originalNode->getModuleCode()),
            $originalNode->getRoute()
        );

        $node->addChildren($children);

        return $node;
    }

    private function passesFactor(NavigationNode $node)
    {
        return in_array($node->getModuleCode(), $this->factor);
    }
    
}