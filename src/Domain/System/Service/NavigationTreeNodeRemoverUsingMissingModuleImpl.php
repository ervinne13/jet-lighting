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
    private $passingCriteria;

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

    public function using($passingCriteria) : NavigationTreeNodeRemover
    {    
        foreach($passingCriteria as $module) {
            $this->passingCriteria[] = $this->getModuleCode($module);
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

            if (!$this->passesFactor($node, $visibleChildNodes)) {
                continue;
            }           
            
            if ($node->isMerelyAContainer()) {
                $passingNode = $this->makeContainerOnlyNode($node, $visibleChildNodes);
            } else {
                $passingNode = $this->makeNode($node, $visibleChildNodes);
            }
            
            $visibleNodes[] = $passingNode;         
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

    private function makeNode(NavigationNode $originalNode, array $children) : NavigationNode
    {
        $moduleCode = $originalNode->getModuleCode() ? new ModuleCode($originalNode->getModuleCode()) : null;
        $node = new NavigationNode(
            $originalNode->getIconClass(),
            $originalNode->getText(),            
            $originalNode->getRoute(),
            $moduleCode
        );

        $node->addChildren($children);

        return $node;
    }

    private function passesFactor(NavigationNode $node, $visibleChildNodes)
    {
        $linkOnlyNode = null === $node->getModuleCode() && $node->getRoute();
        $matchesAModule = in_array($node->getModuleCode(), $this->passingCriteria);
        $nonEmptyContainer = $node->isMerelyAContainer() && count($visibleChildNodes) > 0;

        return $linkOnlyNode || $matchesAModule || $nonEmptyContainer;
    }
    
}