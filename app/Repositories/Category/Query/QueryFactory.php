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
                return $this->queryInstance($this->requestedArgument('categories', [$categories]));
            case !is_null($brand):
                return $this->queryInstance($this->requestedArgument('brand', $brand));
            case !is_null($filter):
                return $this->queryInstance($this->requestedArgument('filters', array($filter)));
            default:
                return $this->queryInstance($this->defaultArguments());

        }

    }

    /**
     * @param $arguments
     * @return Query
     */
    private function queryInstance($arguments)
    {
        return call_user_func_array([__NAMESPACE__ . '\Query', 'newInstance'], $arguments);
    }

    /**
     * Replacing default arguments with specified key value
     *
     * @param $key
     * @param $value
     * @return array
     */
    private function requestedArgument($key, $value)
    {
        return array_replace($this->defaultArguments(), [$key => $value]);
    }

    /**
     * Returning default query arguments
     *
     * @return array
     */
    private function defaultArguments()
    {
        return [
            'categories' => $this->allCategoriesId(),
            'brand' => $this->requestedBrand(),
            'filters' => $this->requestedFilters(),
            'min_price' => $this->requestedMinPrice(),
            'max_price' => $this->requestedMaxPrice()
        ];
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