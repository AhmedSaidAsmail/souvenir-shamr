<?php

namespace App\Repositories\Category\Query;

use App\Repositories\Category\CategoryRepository;

class QueryFactory
{
    /**
     * @var CategoryRepository $repository
     */
    private $repository;

    /**
     * QueryFactory constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Listing Category id and it's childs id
     *
     * @return array
     */
    private function allCategoriesId()
    {
        return array_merge([$this->repository->category->id], array_keys($this->repository->categories));
    }

    /**
     * Determine if request has brand field And Get the brand id
     *
     * @return integer|null
     */
    private function requestedBrand()
    {
        if ($this->repository->request->has('brand')) {
            return $this->repository->request->get('brand');
        }
        return null;
    }

    /**
     * Get requested filters if exists
     *
     * @return array
     */
    private function requestedFilters()
    {
        if ($this->repository->request->has('filters')) {
            return $this->repository->request->get('filters');
        }
        return [];
    }

    /**
     * Get requested min price if exists
     *
     * @return integer|null
     */
    private function requestedMinPrice()
    {
        if ($this->repository->request->has('min_price')) {
            return $this->repository->request->get('min_price');
        }
        return null;
    }

    /**
     * Get requested max price if exists
     *
     * @return integer|null
     */
    private function requestedMaxPrice()
    {
        if ($this->repository->request->has('max_price')) {
            return $this->repository->request->get('max_price');
        }
        return null;
    }

    /**
     * Make Query instance
     *
     * @param null $categories
     * @param null $brand
     * @param null $filter
     * @return Query
     */
    private function factory($categories = null, $brand = null, $filter = null)
    {
        switch (true) {
            case !is_null($categories):
                return new Query(array($categories), $this->requestedBrand(), $this->requestedFilters(), $this->requestedMinPrice(), $this->requestedMaxPrice());
            case !is_null($brand):
                return new Query($this->allCategoriesId(), $brand, $this->requestedFilters(), $this->requestedMinPrice(), $this->requestedMaxPrice());
            case !is_null($filter):
                return new Query($this->allCategoriesId(), $this->requestedBrand(), array($filter), $this->requestedMinPrice(), $this->requestedMaxPrice());
            default:
                return new Query($this->allCategoriesId(), $this->requestedBrand(), $this->requestedFilters(), $this->requestedMinPrice(), $this->requestedMaxPrice());

        }

    }

    /**
     * Make Query instance
     *
     * @param null $categories
     * @param null $brand
     * @param null $filter
     * @return \Illuminate\Database\Query\Builder
     */
    public function makeQuery($categories = null, $brand = null, $filter = null)
    {
        return $this->factory($categories, $brand, $filter)
            ->make()
            ->get();
    }
}