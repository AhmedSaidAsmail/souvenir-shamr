<?php

namespace App\Repositories\Category\Relations;


class Child extends AbstractRelation
{

    /**
     * Counting products
     *
     * @return integer
     */
    public function count()
    {
        return $this->factory
            ->makeQuery($this->model->id)
            ->select('products.id')
            ->distinct('products.id')
            ->get()
            ->count();
    }
}