<?php

namespace App\Repositories\Category\Query;

use Illuminate\Support\Facades\DB;

class Query
{
    private $categories = [];
    private $brand;
    private $filters = [];
    private $min_price;
    private $max_price;
    /**
     * @var \Illuminate\Database\Query\Builder $sql_query
     */
    private $query;

    public function __construct(array $categories, $brand = null, $filters = [], $min_price = null, $max_price = null)
    {
        $this->categories = $categories;
        $this->brand = $brand;
        $this->filters = $filters;
        $this->min_price = $min_price;
        $this->max_price = $max_price;


    }

    public function make()
    {
        return $this->queryInit()
            ->joinCategories()
            ->joinFilters()
            ->filterByCategories()
            ->filterByFilters()
            ->filterByBrand()
            ->filterByPrice()
            ->filterByStatus();
    }

    protected function queryInit()
    {
        $this->query = DB::table('products');
        return $this;

    }

    protected function joinCategories()
    {
        $this->query = $this->query
            ->join('categories', 'products.category_id', '=', 'categories.id');
        return $this;
    }

    protected function joinFilters()
    {
        $this->query = $this->query
            ->join('product_filter_items', 'products.id', '=', 'product_filter_items.product_id');
        return $this;
    }

    protected function filterByCategories()
    {
        $this->query = $this->query
            ->whereIn('categories.id', $this->categories);
        return $this;
    }

    protected function filterByFilters()
    {
        if (!empty($this->filters)) {
            $this->query = $this->query
                ->whereIn('product_filter_items.filter_item_id', $this->filters);
        }
        return $this;
    }

    protected function filterByBrand()
    {
        if (!empty($this->brand)) {
            $this->query = $this->query
                ->where('products.brand_id', $this->brand);
        }
        return $this;
    }

    protected function filterByPrice()
    {
        if (!is_null($this->min_price) && !is_null($this->max_price)) {
            $this->query = $this->query
                ->where('products.price', '>=', $this->min_price)
                ->where('products.price', '<=', $this->max_price);
        }
        return $this;

    }

    protected function filterByStatus()
    {
        $this->query = $this->query
            ->where('products.status', 1);
        return $this;
    }

    public function get()
    {
        return $this->query;
    }

}