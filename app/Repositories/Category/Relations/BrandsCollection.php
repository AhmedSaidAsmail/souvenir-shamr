<?php

namespace App\Repositories\Category\Relations;

use App\Models\Brand as BrandModel;
use App\Repositories\Category\Query\QueryFactory;

class BrandsCollection implements CollectionInterface
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
        return collect($this->convertingToBrand());
    }

    private function convertingToBrand()
    {
        return array_map(function ($attribute) {
            return new Brand($this->factory, BrandModel::findOrFail($attribute->brand_id));
        }, $this->queryResult());

    }

    private function queryResult()
    {
        return $this->factory->makeQuery()
            ->select('products.brand_id')
            ->groupBy('products.brand_id')
            ->get()
            ->all();
    }
}