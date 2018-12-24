<?php

namespace Jet\Infrastructure\System\Service;

use Jet\Domain\System\Service\Builder\NavigationTreeBuilder;
use Jet\Domain\System\ValueObject\ModuleCode;
use Jet\Domain\System\ValueObject\NavigationNode;
use Jet\Domain\System\ValueObject\NavigationTree;

class NavigationTreeBuilderArrayImpl implements NavigationTreeBuilder
{
    public function createFrom(array $nodes) : NavigationTree
    {
        $navTree = new NavigationTree();

        foreach($nodes as $node) {
            $navTree->addChild($this->buildNodeFromAssocArray($node));
        }

        return $navTree;
    }

    private function buildNodeFromAssocArray(array $source) : NavigationNode
    {        
        $node = new NavigationNode(            
            $source['icon_class'],
            $source['text'],
            $this->getModuleCodeFromSource($source),
            data_get($source, 'route', null)
        );

        $children = data_get($source, 'children', []);
        foreach ($children as $child) {
            $node->addChild($this->buildNodeFromAssocArray($child));
        }

        return $node;
    }

    private function getModuleCodeFromSource(array $source) : ?ModuleCode
    {
        return array_key_exists('module', $source) ? new ModuleCode($source['module']) : null;
    }
}