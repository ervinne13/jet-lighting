<?php

namespace Jet\Domain\System\Entity;

use Jet\Infrastructure\System\LocationModel;

/**
 * This entity/model is anemic, it will serve as merely a repository
 * (wihout the "Repository" suffix of course, so we can easily interchange
 * later on). 
 * 
 * We'll just be forwarding concerns to Eloquent for this as there's 
 * not much business rules to constrain here.
 */
class Location
{
    /** @var LocationModel */
    private $model;

    public function __construct(string $name, int $id = null)
    {
        $this->model = new LocationModel();
        $this->model->display_name = $name;

        if ($id) {
            $this->model->id = $id;
        }
    }

    public function getid()
    {
        return $this->id;
    }

    public function save() : Location
    {
        $this->model->save();
        $this->id = $this->model->id;
        return $this;        
    }

}