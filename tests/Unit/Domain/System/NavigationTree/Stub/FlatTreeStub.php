<?php

namespace Tests\Unit\Domain\System\NavigationTree\Stub;

use Jet\Domain\System\ValueObject\ModuleCode;
use Jet\Domain\System\ValueObject\NavigationNode;
use Jet\Domain\System\ValueObject\NavigationTree;

class FlatTreeStub
{
    public static function get() : NavigationTree
    {
        $navTree = new NavigationTree();

        $navTree->addChildren([
            new NavigationNode(
                'fa fa-users',
                'User Management',
                new ModuleCode('U'),
                'users'
            ),
            new NavigationNode(
                'fa fa-file-alt',
                'Tracking Number',
                new ModuleCode('TN'),
                'tracking-numbers'
            ),
        ]);

        return $navTree;       
    }
}