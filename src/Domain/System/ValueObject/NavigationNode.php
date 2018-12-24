<?php

namespace Jet\Domain\System\ValueObject;

use Jet\Domain\System\ValueObject\ModuleCode;

class NavigationNode
{
    /** @var string */
    private $moduleCode;    

    /** @var string */
    private $iconClass;

    /** @var string */
    private $text;

    /** @var string */
    private $route;

    /** @var array */
    private $children;

    public function __construct(                 
        string $iconClass, 
        string $text,
        ModuleCode $moduleCode = null,
        string $route = null
    ) {        
        $this->iconClass = $iconClass;
        $this->text = $text;

        if ($moduleCode) {
            $this->moduleCode = $moduleCode->getStringVal();
        }

        $this->route = $route;

        $this->children = [];
    }

    public function addChild(NavigationNode $node)
    {
        $this->children[] = $node;
    }
    
    public function isMerelyAContainer() : bool
    {
        return $this->route === null && count($this->children) > 0;
    }

    public function getModuleCode() : string
    {
        return $this->moduleCode;
    }

    public function getRoute() : ?string
    {
        return $this->route;
    }

    public function getIconClass() : string
    {
        return $this->iconClass;
    }

    public function getText() : string
    {
        return $this->text;
    }

    public function getChildren() : array
    {
        return $this->children;
    }
}