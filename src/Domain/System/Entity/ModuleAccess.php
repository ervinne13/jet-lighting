<?php

namespace Jet\Domain\System\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\ValueObject\AccessControl;
use Jet\Domain\System\ValueObject\ModuleCode;
use JsonSerializable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="role_accessible_modules")
 */
class ModuleAccess
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="accessControlList")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * @var Role
     */
    private $role;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumn(name="module_code", referencedColumnName="code")
     */
    private $module;

    /**
     * @ORM\Column(type="string", name="access_control")
     */
    private $accessControl;

    public function __construct(Module $module, AccessControl $accessControl)
    {        
        $this->module = $module;
        $this->accessControl = $accessControl->getStringVal();
    }

    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    public function getModule() : Module
    {
        return $this->module;
    }
   
    public function getAccessControl() : AccessControl
    {
        return new AccessControl($this->accessControl);
    }
}