<?php

namespace App\Repositories\Category;

use Illuminate\Support\Facades\DB;
use App\Models\FilterItem;

class Filters extends AbstractItems
{
    private function result()
    {
        return collect($this->resolve());
    }

    private function resolve()
    {
        return array_map(function ($filter) {
            return new FilterRepository($filter['filter'], $filter['items']);
        }, $this->rebuildArrayAccordingToFilterId());
    }

    private function rebuildArrayAccordingToFilterId()
    {
        $result = [];
        foreach ($this->convertArrayToModels() as $attribute) {
            $parent = $attribute['filter_item']->filter;
            $result[$parent->id]['filter'] = $parent;
            $result[$parent->id]['items'][] = $attribute;
        }
        return $result;
    }

    private function convertArrayToModels()
    {
        return array_map(function ($attribute) {
            return [
                'filter_item' => FilterItem::findOrFail($attribute->filter_item_id),
                'products' => $attribute->filter_counts];
        }, $this->makeQuery());
    }

    private function makeQuery()
    {
        return $this->query
            ->select('product_filter_items.filter_item_id', DB::raw('count(products.id) as filter_counts'))
            ->groupBy('product_filter_items.filter_item_id')
            ->get()
            ->all();
    }

    /**
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    function get($limit = null, $offset = null)
    {
        return $this->result();
    }
}