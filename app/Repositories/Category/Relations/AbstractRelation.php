<?php

namespace App\Repositories\Category\Relations;

use App\Repositories\Category\Query\QueryFactory;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRelation
{
    protected $model;
    protected $factory;

    public function __construct(QueryFactory $factory, Model $model)
    {
        $this->model = $model;
        $this->factory = $factory;
    }

    /**
     * Counting products
     *
     * @return integer
     */
    abstract public function count();

    public function __get($name)
    {
        return $this->model->{$name};
    }

    public function __invoke()
    {
        return $this->model;
    }

}