<?php

namespace App\Repositories\Category;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class Brands extends AbstractItems
{

    private function result()
    {
//        return collect(array_map(function ($attribute) {
//            return Brand::findOrFail($attribute->brand_id)->setCount(10);
//        }, $this->makeQuery()));
        return $this->makeQuery();
    }

    private function makeQuery()
    {
        return $this->query
//            ->select('products.brand_id','products.id',DB::raw('count(products.id) as products'))
//            ->groupBy(['products.brand_id','products.id'])
            ->select('products.brand_id')
            ->groupBy('products.brand_id')
            ->get()
            ->all();
    }

    function get($limit = null, $offset = null)
    {
        return $this->result();
    }
}