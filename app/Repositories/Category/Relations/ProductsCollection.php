<?php


namespace App\Repositories\Category\Relations;

use App\Repositories\Category\Query\QueryFactory;
use App\Models\Product;

class ProductsCollection implements CollectionInterface
{
    /**
     * @var QueryFactory $factory
     */
    private $factory;
    private $query;

    public function __construct(QueryFactory $factory)
    {
        $this->factory = $factory;
        $this->query = $factory->makeQuery();
    }

    /**
     * @param null $limit
     * @param null $offset
     * @return \Illuminate\Support\Collection
     */
    function get($limit = null, $offset = null)
    {
        return collect(array_map(function ($attribute) {
            return Product::findOrFail($attribute->id);
        }, $this->queryResult($limit, $offset)));
    }

    private function queryResult($limit = null, $offset = null)
    {
        return $this->initQuery()
            ->prepareLimit($limit)
            ->prepareOffset($offset)
            ->makeQuery();

    }

    private function initQuery()
    {
        $this->query
            ->select('products.id')
            ->distinct('products.id');
        return $this;
    }

    private function prepareOffset($offset = null)
    {
        if (!is_null($offset)) {
            $this->query
                ->offset($offset);
        }
        return $this;
    }

    private function prepareLimit($limit = null)
    {
        if (!is_null($limit)) {
            $this->query
                ->limit($limit);
        }
        return $this;
    }

    private function makeQuery()
    {
        return $this->query
            ->orderBy('products.sort_order')
            ->orderBy('products.id')
            ->get()
            ->all();
    }
}