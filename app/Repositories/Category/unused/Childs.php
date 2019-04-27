<?php

namespace App\Repositories\Category;

use Illuminate\Database\Query\Builder;

class Childs
{
    private $childs;
    private $builder;

    public function __construct(array $child, Builder $builder)
    {
        $this->childs = $child;
        $this->builder = $builder;
    }

    public function get()
    {
        return collect(array_map(function ($category) {
            return new ChildRepository($category, clone $this->builder);
        }, $this->childs));
    }

}