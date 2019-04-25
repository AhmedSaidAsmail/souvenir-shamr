<?php

namespace App\Repositories\Category;


use App\Models\Filter;

class FilterRepository
{
    private $filter;
    private $items;


    public function __construct(Filter $filter, array $items)
    {
        $this->filter = $filter;
        $this->items = collect($this->convertItems($items));
    }

    private function convertItems(array $items)
    {
        return array_map(function ($item) {
            return new FilterItemRepository($item['filter_item'], $item['products']);
        }, $items);
    }

    public function items()
    {
        return $this->items;

    }

    public function __get($name)
    {
        return $this->filter->{$name};
    }

}