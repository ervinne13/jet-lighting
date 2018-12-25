<?php

namespace Tests\Unit\Domain\System\NavigationTree\Stub;

use Jet\Domain\System\ValueObject\ModuleCode;
use Jet\Domain\System\ValueObject\NavigationNode;
use Jet\Domain\System\ValueObject\NavigationTree;

class NestedTreeStub
{
    public static function get() : NavigationTree
    {
        $navTree = new NavigationTree();

        $navTree->addChildren([
            new NavigationNode(
                'fa fa-users',
                'User Management',
                'users',
                new ModuleCode('U')
            ),
            static::makeNodeWithChildren()
        ]);

        return $navTree;       
    }

    private static function makeNodeWithChildren() : NavigationNode
    {
        $parentNode = new NavigationNode(
            'fa fa-file',
            'Grouped Modules'
        );

        $parentNode->addChildren([
            new NavigationNode(
                'fa fa-file',
                'Child Module 1',                
                'child-module-1',
                new ModuleCode('CH1')
            ),
            new NavigationNode(
                'fa fa-file',
                'Child Module 2',
                'child-module-2',
                new ModuleCode('CH2')
            ),
        ]);

        return $parentNode;
    }
}