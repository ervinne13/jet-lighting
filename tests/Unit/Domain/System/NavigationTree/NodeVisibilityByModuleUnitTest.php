<?php

namespace Tests\Unit\Domain\System\NavigationTree;

use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\Service\NavigationTreeNodeRemover;
use Jet\Domain\System\Service\NavigationTreeNodeRemoverUsingMissingModuleImpl;
use Jet\Domain\System\ValueObject\ModuleCode;
use Jet\Domain\System\ValueObject\NavigationTree;
use Tests\TestCase;
use Tests\Unit\Domain\System\NavigationTree\Stub\FlatTreeStub;
use Tests\Unit\Domain\System\NavigationTree\Stub\HasNonModuleBoundNodeTreeStub;
use Tests\Unit\Domain\System\NavigationTree\Stub\NestedTreeStub;

class NodeVisibilityByModuleUnitTest extends TestCase
{
    /** NavigationTreeNodeRemover */
    private $nodeRemover;

    public function setup()
    {
        parent::setup();
        $this->nodeRemover = new NavigationTreeNodeRemoverUsingMissingModuleImpl();        
    }

    /**
     * @test
     */
    public function it_can_hide_a_module_from_flat_tree()
    {
        $originalTree = FlatTreeStub::get();        
        $module = new Module(new ModuleCode('U'), 'Users');

        $modifiedTree = $this->nodeRemover
            ->removeFrom($originalTree)
            ->using([$module])
            ->getResultingTree();

        $modifiedTreeChildren = $modifiedTree->getChildren();

        $this->assertTrue(count($modifiedTreeChildren) < count($originalTree->getChildren()));
        $this->assertEquals('U', $modifiedTreeChildren[0]->getModuleCode());
    }

    /**
     * @test
     */
    public function it_can_hide_a_module_inside_another_module()
    {
        $originalTree = NestedTreeStub::get();        
        $modules = [
            new Module(new ModuleCode('U'), 'Users'),
            new Module(new ModuleCode('CH1'), 'Child Module 1')
        ];

        $modifiedTree = $this->nodeRemover
            ->removeFrom($originalTree)
            ->using($modules)
            ->getResultingTree();

        //  the root node count should stay the same as CH1 is inside another node
        $this->assertEquals(count($originalTree->getChildren()), count($modifiedTree->getChildren()));

        $this->assertModifiedTreeHasLessDeepChildren($originalTree, $modifiedTree);

        $groupedNode = $modifiedTree->getChildren()[1];
        $this->assertEquals('CH1', $groupedNode->getChildren()[0]->getModuleCode());
    }

    private function assertModifiedTreeHasLessDeepChildren($originalTree, $modifiedTree)
    {
        $originalGroupedModulesChildren = $originalTree->getChildren()[1]->getChildren();
        $modifiedGroupedModulesChildren = $modifiedTree->getChildren()[1]->getChildren();
        $this->assertTrue(count($modifiedGroupedModulesChildren) < count($originalGroupedModulesChildren));
    }

    /**
     * @test
     */
    public function it_can_hide_a_container_that_has_no_child_modules()
    {
        $originalTree = NestedTreeStub::get();        
        $modules = [
            new Module(new ModuleCode('U'), 'Users')
        ];

        $modifiedTree = $this->nodeRemover
            ->removeFrom($originalTree)
            ->using($modules)
            ->getResultingTree();
        
        $this->assertEquals(1, count($modifiedTree->getChildren()));
        $this->assertEquals('U', $modifiedTree->getChildren()[0]->getModuleCode());
    }

    /**
     * @test
     */
    public function it_always_includes_non_module_bound_nodes()
    {
        $originalTree = HasNonModuleBoundNodeTreeStub::get();        
        $modules = [
            new Module(new ModuleCode('U'), 'Users')
        ];

        $this->createModifiedTreeAndAssertNonModuleBoundNodeExists($originalTree, $modules);
    }

    private function createModifiedTreeAndAssertNonModuleBoundNodeExists(NavigationTree $originalTree, array $modules)
    {
        $modifiedTree = $this->nodeRemover
            ->removeFrom($originalTree)
            ->using($modules)
            ->getResultingTree();
    
        $this->assertEquals('dashboard', $modifiedTree->getChildren()[0]->getRoute());
    }

}