<?php

namespace Jet\Domain\System\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\Entity\ModuleAccess;
use Jet\Domain\System\ValueObject\ModuleCode;
use JsonSerializable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role implements JsonSerializable
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
    * @ORM\OneToMany(targetEntity="ModuleAccess", mappedBy="role", cascade={"persist"})
    */
    private $accessControlList;

    public function __construct(string $name, array $accessControlList = [])
    {        
        $this->name = $name;
        $this->accessControlList = $accessControlList;
    }

    public function getid() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getAccessControlList() : array
    {
        return is_array($this->accessControlList) ?: $this->accessControlList->toArray();
    }

    public function jsonSerialize()
    {
        $acl = [];
        foreach($this->getAccessControlList() as $ac) {
            $acl[] = [
                'module' => $ac->getModule()->jsonSerialize(),
                'access' => $ac->getAccessControl()->getStringVal()
            ];
        }

        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'accessControlList' => $acl
        ];
    }
}