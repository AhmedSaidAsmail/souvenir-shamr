<?php

namespace App\Repositories\Category;

use App\Models\Product;

class Products extends AbstractItems
{
    private function result()
    {

        return collect(array_map(function ($attribute) {
            return Product::findOrFail($attribute->id);
        }, $this->makeQuery()));
    }

    private function makeQuery()
    {
        return $this->query
            ->orderBy('products.sort_order')
            ->orderBy('products.id')
            ->get()
            ->all();
    }

    private function prepareQuery($limit = null, $offset = null)
    {
        return $this->prepareSelect()
            ->prepareOffset($offset)
            ->prepareLimit($limit);
    }

    private function prepareSelect()
    {
        $this->query = $this->query
            ->select('products.*')
            ->distinct('products.id');
        return $this;
    }

    private function prepareOffset($offset = null)
    {
        if (!is_null($offset)) {
            $this->query = $this->query
                ->offset($offset);
        }
        return $this;
    }

    private function prepareLimit($limit = null)
    {
        if (!is_null($limit)) {
            $this->query = $this->query
                ->limit($limit);
        }
        return $this;
    }

    /**
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    function get($limit = null, $offset = null)
    {
        $this->prepareQuery($limit, $offset);
        return $this->result($limit, $offset);

    }
}