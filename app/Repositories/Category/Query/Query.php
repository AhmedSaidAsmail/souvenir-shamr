<?php

namespace App\Repositories\Category\Query;

use Illuminate\Support\Facades\DB;

class Query
{
    /**
     * @var array $categories requested categories id list
     */
    private $categories = [];
    /**
     * @var null|integer $brand requested brand id
     */
    private $brand;
    /**
     * @var array $filters Requested filter_items id
     */
    private $filters = [];
    /**
     * @var null|integer $min_price Requested min price
     */
    private $min_price;
    /**
     * @var null|integer $max_price Requested max price
     */
    private $max_price;
    /**
     * @var \Illuminate\Database\Query\Builder $sql_query
     */
    private $query;

    /**
     * Query constructor.
     * @param array $categories
     * @param null $brand
     * @param array $filters
     * @param null $min_price
     * @param null $max_price
     */
    public function __construct(array $categories, $brand = null, $filters = [], $min_price = null, $max_price = null)
    {
        $this->categories = $categories;
        $this->brand = $brand;
        $this->filters = $filters;
        $this->min_price = $min_price;
        $this->max_price = $max_price;


    }

    /**
     * Making new Query instance
     *
     * @param array $categories
     * @param null $brand
     * @param array $filters
     * @param null $min_price
     * @param null $max_price
     * @return Query
     */
    public static function newInstance(array $categories, $brand = null, $filters = [], $min_price = null, $max_price = null)
    {
        return new self($categories, $brand, $filters, $min_price, $max_price);
    }

    /**
     * Make Query builder instance
     *
     * @return $this
     */
    public function make()
    {
        $this->prepareQuery();
        return $this;
    }

    /**
     * Preparing Query Builder according to requested fields
     */
    private function prepareQuery()
    {
        $this->queryInit()
            ->joinCategories()
            ->joinFilters()
            ->filterByCategories()
            ->filterByFilters()
            ->filterByBrand()
            ->filterByPrice()
            ->filterByStatus();
    }

    /**
     * Init new Query Builder
     *
     * @return $this
     */
    private function queryInit()
    {
        $this->query = DB::table('products');
        return $this;

    }

    /**
     * Joining categories table
     *
     * @return $this
     */
    private function joinCategories()
    {
        $this->query
            ->join('categories', 'products.category_id', '=', 'categories.id');
        return $this;
    }

    /**
     * Joining filter items table
     *
     * @return $this
     */
    protected function joinFilters()
    {
        $this->query
            ->join('product_filter_items', 'products.id', '=', 'product_filter_items.product_id');
        return $this;
    }

    /**
     * Filtering by requested categories
     *
     * @return $this
     */
    protected function filterByCategories()
    {
        $this->query
            ->whereIn('categories.id', $this->categories);
        return $this;
    }

    /**
     * Filtering by requested filter items
     *
     * @return $this
     */
    protected function filterByFilters()
    {
        if (!empty($this->filters)) {
            $this->query
                ->whereIn('product_filter_items.filter_item_id', $this->filters);
        }
        return $this;
    }

    /**
     * Filtering by requested brand
     *
     * @return $this
     */

    protected function filterByBrand()
    {
        if (!empty($this->brand)) {
            $this->query
                ->where('products.brand_id', $this->brand);
        }
        return $this;
    }

    /**
     * Filtering by requested price min and max
     *
     * @return $this
     */

    protected function filterByPrice()
    {
        if (!is_null($this->min_price) && !is_null($this->max_price)) {
            $this->query
                ->where('products.price', '>=', $this->min_price)
                ->where('products.price', '<=', $this->max_price);
        }
        return $this;

    }

    /**
     * Filtering by products status
     *
     * @return $this
     */
    protected function filterByStatus()
    {
        $this->query
            ->where('products.status', 1);
        return $this;
    }

    /**
     * Get Query Builder instance
     *
     * @return \Illuminate\Database\Query\Builder
     */

    public function get()
    {
        return $this->query;
    }

}