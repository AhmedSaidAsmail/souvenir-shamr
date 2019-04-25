<?php

namespace App\Repositories\Category;

use App\Models\FilterItem;

class FilterItemRepository
{
    private $filterItem;
    private $count;

    public function __construct(FilterItem $filterItem, $count)
    {
        $this->filterItem = $filterItem;
        $this->count = $count;
    }

    public function count()
    {
        return $this->count;
    }

    public function __get($name)
    {
        return $this->filterItem->{$name};
    }

}