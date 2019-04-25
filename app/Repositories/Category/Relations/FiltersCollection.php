<?php

namespace App\Repositories\Category\Relations;

use App\Repositories\Category\Query\QueryFactory;
use Illuminate\Support\Facades\DB;
use App\Models\FilterItem;

class FiltersCollection implements CollectionInterface

{
    /**
     * @var QueryFactory $factory
     */
    private $factory;

    public function __construct(QueryFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param null $limit
     * @param null $offset
     * @return \Illuminate\Support\Collection
     */
    function get($limit = null, $offset = null)
    {
        return collect(array_map(function ($attribute) {
            return (new Filter($this->factory, $attribute['filter']))
                ->setItems($attribute['items']);
        }, $this->sortingByFilter()));
        //return $this->sortingByFilter();
    }

    private function queryResult()
    {
        return $this->factory
            ->makeQuery()
            ->select('product_filter_items.filter_item_id', DB::raw('count(products.id) as filter_counts'))
            ->groupBy('product_filter_items.filter_item_id')
            ->get()
            ->all();
    }

    private function convertArrayToModels()
    {
        return array_map(function ($attribute) {
            return [
                'filter_item' => FilterItem::findOrFail($attribute->filter_item_id),
                'count' => $attribute->filter_counts];
        }, $this->queryResult());
    }

    private function sortingByFilter()
    {
        $result = [];
        foreach ($this->convertArrayToModels() as $attribute) {
            $parent = $attribute['filter_item']->filter;
            $result[$parent->id]['filter'] = $parent;
            $result[$parent->id]['items'][] = $attribute;
        }
        return $result;
    }
}