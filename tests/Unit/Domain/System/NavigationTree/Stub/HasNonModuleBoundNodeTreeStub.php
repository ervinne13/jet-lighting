<?php

namespace Tests\Unit\Domain\System\NavigationTree\Stub;

use Jet\Domain\System\ValueObject\ModuleCode;
use Jet\Domain\System\ValueObject\NavigationNode;
use Jet\Domain\System\ValueObject\NavigationTree;

class HasNonModuleBoundNodeTreeStub
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
            new NavigationNode(
                'fa fa-file-alt',
                'Tracking Number',                
                'tracking-numbers'
            ),
            new NavigationNode(
                'fa fa-file-alt',
                'Tracking Number',                
                'tracking-numbers',
                new ModuleCode('TN')
            ),
        ]);

        return $navTree;       
    }
}