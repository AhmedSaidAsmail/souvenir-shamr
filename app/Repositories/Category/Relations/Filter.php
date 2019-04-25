<?php

namespace App\Repositories\Category\Relations;


class Filter extends AbstractRelation
{
    private $items = [];

    /**
     * Counting products
     *
     * @return integer
     */
    public function count()
    {
        // TODO: Implement count() method.
    }

    public function setItems(array $items)
    {
        $this->items = $items;
        return $this;
    }

    public function items()
    {
        return collect(array_map(function ($attribute) {
            return (new FilterItem($this->factory, $attribute['filter_item']))
                ->setCount($attribute['count']);
        }, $this->items));
    }
}