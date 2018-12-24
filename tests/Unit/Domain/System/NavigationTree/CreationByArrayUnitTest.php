<?php

namespace Tests\Unit\Domain\System\NavigationTree;

use Jet\Domain\System\ValueObject\NavigationNode;
use Jet\Infrastructure\System\Service\NavigationTreeBuilderArrayImpl;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\System\NavigationTree\Stub\FileSource\FlatSourceStub;
use Tests\Unit\Domain\System\NavigationTree\Stub\FileSource\NestedSourceStub;

class CreationByArrayUnitTest extends TestCase
{
    /**
     * @var NavigationTreeBuilderArrayImpl;
     */
    private $builder;

    public function setup()
    {
        parent::setup();
        $this->builder = new NavigationTreeBuilderArrayImpl();
    }

    /**
     * @test
     */
    public function it_can_create_a_flat_tree()
    {
        $source = FlatSourceStub::get();
        $navigationTree = $this->builder->createFrom($source);

        $this->assertIteratableHasNavigationNodes($navigationTree->getChildren());
    }
    
    /**
     * @test
     */
    public function it_can_create_a_tree_with_nested_nodes()
    {
        $source = NestedSourceStub::get();
        $navigationTree = $this->builder->createFrom($source);

        $this->assertIteratableHasNavigationNodes($navigationTree->getChildren());
    }

    private function assertIteratableHasNavigationNodes($iteratable)
    {
        foreach($iteratable as $node) {
            $this->assertInstanceOf(NavigationNode::class, $node);
            
            //  recursively check
            $this->assertIteratableHasNavigationNodes($node->getChildren());
        }
    }

    /**
     * @test
     */
    public function it_can_distinguish_container_only_nodes()
    {
        $source = NestedSourceStub::get();
        $navigationTree = $this->builder->createFrom($source);

        $this->assertCount(2, $navigationTree->getChildren());
        $this->assertFalse($navigationTree->getChildren()[0]->isMerelyAContainer());
        $this->assertTrue($navigationTree->getChildren()[1]->isMerelyAContainer());
    }
}