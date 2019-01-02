<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping AS ORM;
use JsonSerializable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_categories")
 */
class ItemCategory implements JsonSerializable
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue     
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="category", cascade={"all"})     
     */
    private $items;

    public function __construct(string $name, string $description = null)
    {
        $this->name = $name;
        $this->description = $description;
    }    

    public function jsonSerialize()
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
        ];
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getItems() : Collection
    {
        //  PersistentCollection
        return $this->items;
    }
}