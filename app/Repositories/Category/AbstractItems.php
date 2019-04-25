<?php

namespace App\Repositories\Category;

use Illuminate\Database\Query\Builder;

abstract class AbstractItems
{
    /**
     * @var Builder $builder
     */
    protected $query;

    public function __construct(Builder $builder)
    {
        $this->query = $builder;
    }

    /**
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    abstract function get($limit=null,$offset=null);

}