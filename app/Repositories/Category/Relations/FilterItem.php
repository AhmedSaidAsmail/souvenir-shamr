<?php

namespace App\Repositories\Category\Relations;


class FilterItem extends AbstractRelation
{
    private $count;

    /**
     * Counting products
     *
     * @return integer
     */
    public function count()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }
}