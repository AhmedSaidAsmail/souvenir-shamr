<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Filter;
use App\Models\FilterItem;
use Illuminate\Http\Request;

/**
 * Class Category
 * @package App\Repositories
 * @method void setCategories(array $attribute)
 * @method Category[]|[] getCategories()
 * @method void setProducts(array $attribute)
 * @method Product[]|[] getProducts()
 * @method void setFilters(array $attribute)
 * @method Filter[]|[] getFilters()
 * @method void setFilterItems(array $attribute)
 * @method FilterItem[]|[] getFilterItems()
 * @method void setMinPrice(int $price)
 * @method int|null getMinPrice()
 * @method void setMaxPrice(int $price)
 * @method int|null getMaxPrice()
 */
class CategoryRepo
{
    /**
     * @var Category $category
     */
    public $category;
    /**
     * @var Category[] $categories
     */
    protected $categories = [];
    /**
     * @var Product[] $products
     */
    public $products = [];
    /**
     * @var Filter[] $filters
     */
    protected $filters = [];
    /**
     * @var FilterItem[] $filterItems
     */
    protected $filterItems = [];
    /**
     * @var integer $minPrice
     */
    protected $minPrice;
    /**
     * @var integer $maxPrice
     */
    protected $maxPrice;
    /**
     * @var Request $request
     */
    protected $request;

    /**
     * CategoryRepo constructor.
     * @param Category $category
     * @param Request $request
     */
    public function __construct(Category $category, Request $request)
    {
        $this->category = $category;
        $this->request = $request;
    }

    public function find($id, Request $request)
    {
        $this->category = Category::findOrFail($id);
        $this->addCategoryChilds();
        $this->products = (new ProductsRepo($this, $request))
            ->products($this->allCategoriesId(), $this->requestedBrands());
        //(new ProductsRepo($this,$request))->products();

    }

    private function addCategoryChilds()
    {
        if ($this->categoryHasChilds()) {
            $childs = $this->childsList($this->category->allChildren());
            $this->addChildsToList($childs);
        }

    }

    private function addChildsToList(array &$childs)
    {
        array_walk($childs, function (Category $category) {
            $this->categories[$category->id] = $category;
        });
    }

    private function childsList(array $childs)
    {
        if ($this->requestHasCategories()) {
            return array_filter($childs, function (Category $category) {
                return in_array($category->id, $this->requestCategories());
            });
        }
        return $childs;
    }

    private function requestHasCategories()
    {
        return $this->request->has('categories');
    }

    private function requestCategories()
    {
        return $this->request->get('categories');
    }

    private function categoryHasChilds()
    {
        return count($this->category->allChildren()) > 0;
    }

    private function allCategoriesId()
    {
        return array_merge([$this->category->id], array_keys($this->getCategories()));
    }

    private function requestedBrands()
    {
        if ($this->request->has('brands')) {
            return $this->request->get('brands');
        }
        return null;
    }

    /**
     * Set exists property
     *
     * @param $method
     * @param $arguments
     */
    private function setMutator($method, $arguments)
    {
        $parts = $this->mutatorParts($method);
        $this->{lcfirst($parts[2])} = $arguments;
    }

    /**
     * Determine if method is a set mutator for an attribute.
     *
     * @param $method
     * @return bool
     */
    private function isSetMutator($method)
    {
        $parts = $this->mutatorParts($method);
        return $this->validateMutatorParts($parts) && $parts[1] == "set" && property_exists($this, strtolower($parts[2]));

    }

    /**
     * Get exists property
     *
     * @param $method
     * @return mixed
     */
    private function getMutator($method)
    {
        $parts = $this->mutatorParts($method);
        return $this->{lcfirst($parts[2])};
    }

    /**
     * Determine if method is a get mutator for an attribute.
     *
     * @param $method
     * @return bool
     */
    private function isGetMutator($method)
    {
        $parts = $this->mutatorParts($method);
        return $this->validateMutatorParts($parts) && $parts[1] == "get" && property_exists($this, strtolower($parts[2]));

    }

    /**
     * Validate mutator list
     *
     * @param array $parts
     * @return bool
     */
    private function validateMutatorParts(array $parts = [])
    {
        return count($parts) == 3 && $parts !== false;
    }

    /**
     * Extract mutator parts
     *
     * @param $method
     * @return bool
     */
    private function mutatorParts($method)
    {
        preg_match('/^(set|get)([a-zA-Z]+)/', $method, $matches);
        return !empty($matches) ? $matches : false;
    }

    /**
     * Handle dynamic method calls into the object.
     *
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if ($this->isSetMutator($method)) {
            $this->setMutator($method, $arguments);
        } elseif ($this->isGetMutator($method)) {
            return $this->getMutator($method);
        }

    }

}