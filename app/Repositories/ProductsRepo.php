<?php

namespace App\Repositories;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsRepo
{
    private $category_repo;
    /**
     * @var \Illuminate\Database\Query\Builder $sql_query
     */
    private $sql_query;
    /**
     * @var Request $request
     */
    private $request;

    public function __construct(CategoryRepo $categoryRepo, Request $request)
    {
        $this->category_repo = $categoryRepo;
        $this->request = $request;
    }

    public function products(array $categories, $brand = null, $filter = null)
    {
        // return  $this->convertStdToEloquent($this->allProducts($categories, $brand, $filter));
        return $this->allProducts($categories, $brand, $filter);
    }

    private function allProducts(array $categories, $brand = null, $filter = null)
    {
        return $this->getAllProducts()
            ->getCategoriesProducts($categories)
            ->joinFilters()
            ->filterByFilters($filter)
            ->filterByBrands($brand)
            ->getQueryResult();

    }

    private function getAllProducts()
    {
        $this->sql_query = DB::table('products')
            ->where('products.status', 1);
        return $this;
    }

    protected function getCategoriesProducts($categories = [])
    {
        $this->sql_query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->whereIn('categories.id', $categories)
            ->where('products.status', 1);
        return $this;
    }

    protected function joinFilters()
    {
        $this->sql_query = $this->sql_query
            ->join('product_filter_items', 'products.id', '=', 'product_filter_items.product_id');
        return $this;
    }

    private function filterByBrands($brand = null)
    {
        if (!is_null($brand)) {
            $this->sql_query = $this->sql_query
                ->whereIn('products.brand_id', $brand);
        }
        return $this;

    }

    protected function filterByFilters(array $filters = null)
    {
        if (!is_null($filters)) {
            $this->sql_query = $this->sql_query
                ->whereIn('product_filter_items.filter_item_id', $filters);
        }
        return $this;
    }

    private function getQueryResult()
    {
        return $this->sql_query
//            ->select('products.*')
//            ->distinct('products.id')
//            ->select('product_filter_items.filter_item_id',DB::raw('count(product_filter_items.filter_item_id) as filter_counts'))
//            ->groupBy('.product_filter_items.filter_counts')
            ->select('product_filter_items.filter_item_id',DB::raw('count(products.id) as filter_counts'))
            ->groupBy('product_filter_items.filter_item_id')
            //->distinct('product_filter_items.filter_item_id')
            ->get()
            ->all();
    }

    private function allCategoriesId()
    {
        return array_merge([$this->category_repo->category->id], array_keys($this->category_repo->getCategories()));
    }

    private function convertStdToEloquent($attributes)
    {
        return array_map(function ($attributes) {
            return Product::findOrFail($attributes->id);
        }, $attributes);
    }
}