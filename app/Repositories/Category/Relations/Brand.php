<?php

namespace App\Repositories\Category\Relations;


class Brand extends AbstractRelation
{

    /**
     * Counting products
     *
     * @return integer
     */
    public function count()
    {
        return  $this->factory
            ->makeQuery(null, $this->model->id)
            ->select('products.id')
            ->distinct('products.id')
            ->get()
            ->count();
    }
}