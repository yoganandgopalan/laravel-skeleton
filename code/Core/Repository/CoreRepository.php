<?php

namespace Code\Core\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

abstract class CoreRepository extends BaseRepository
{

    //Assign the relevant mode class
    abstract public function assignModel();

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return $this->assignModel();
    }

    /**
     *  Need to refactor
     * @return mixed
     */
    public function latest()
    {
        $this->applyCriteria();
        return $this->model->latest($this->model->getKeyName())->get();
    }

    /**
     * Need to refactor
     * @return $this
     */
    public function applyCriteria()
    {
        View::share('model', $this->model);

        if ($this->skipCriteria === true)
            return $this;

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }
}
