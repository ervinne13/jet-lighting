<?php

namespace Jet\Domain\System\ValueObject;

use Jet\Domain\System\ValueObject\ModuleCode;
use Jet\Domain\System\ValueObject\NavigationNodesParent;
use Jet\Domain\System\ValueObject\NavigationTree;

class NavigationNode extends NavigationTree implements NavigationNodesParent
{
    /** @var string */
    private $moduleCode;    

    /** @var string */
    private $iconClass;

    /** @var string */
    private $text;

    /** @var string */
    private $route;

    /** @var bool */
    private $isVisible;

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
        $this->isVisible = true;
    }    
    
    public function isMerelyAContainer() : bool
    {
        return $this->route === null && $this->getChildCount() > 0;
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

    public function getChildCount() : int
    {
        return count($this->getChildren());
    }

    public function __toString()
    {
        $childCount = $this->getChildCount();
        return "{$this->text}: {$childCount}";
    }

}