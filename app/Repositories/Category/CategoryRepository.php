<?php

namespace App\Repositories\Category;

use App\Repositories\Category\Relations\BrandsCollection;
use App\Repositories\Category\Relations\ChildsCollection;
use App\Repositories\Category\Relations\FiltersCollection;
use App\Repositories\Category\Relations\Price;
use App\Repositories\Category\Relations\ProductsCollection;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\Category\Query\QueryFactory;

class CategoryRepository
{
    /**
     * @var Request $request
     */
    public $request;
    /**
     * @var Category $category ;
     */
    public $category;
    /**
     * @var Category[] $categories
     */
    public $categories = [];

    public function __construct(Request $request, $id)
    {
        $this->request = $request;
        $this->category = Category::findOrFail($id);
        $this->setCategoryList();
        //$this->query = (new QueryFactory($this))->makeQuery();
    }

    /**
     * Set categories list
     */
    private function setCategoryList()
    {
        if ($this->categoryHasChilds()) {
            $childs = $this->childsList($this->category->allChildren());
            $this->addChildsToList($childs);
        }

    }

    /**
     * Determine if the requested category has kids
     *
     * @return bool
     */
    private function categoryHasChilds()
    {
        return count($this->category->allChildren()) > 0;
    }

    /**
     * Set category list if it requested , if the request not have requested categories
     * the all categories kids will be included
     *
     * @param array $childs
     * @return array
     */
    private function childsList(array $childs)
    {
        if ($this->requestHasCategories()) {
            return array_filter($childs, function (Category $category) {
                return in_array($category->id, $this->requestCategories());
            });
        }
        return $childs;
    }

    /**
     * Determine if request object has requested categories
     *
     * @return bool
     */
    private function requestHasCategories()
    {
        return $this->request->has('categories');
    }

    /**
     * Fetching all requested categories
     *
     * @return mixed
     */
    private function requestCategories()
    {
        return $this->request->get('categories');
    }

    /**
     * Set Categories kids list
     *
     * @param array $childs
     */
    private function addChildsToList(array &$childs)
    {
        array_walk($childs, function (Category $category) {
            $this->categories[$category->id] = $category;
        });
    }

    public function products($limit = null, $offset = null)
    {
        return (new ProductsCollection($this->newQueryFactoryInstance()))
            ->get($limit, $offset);
    }

    public function filters()
    {
        return (new FiltersCollection($this->newQueryFactoryInstance()))
            ->get();
    }

    public function brands()
    {
        return (new BrandsCollection($this->newQueryFactoryInstance()))
            ->get();
    }

    public function childs()
    {
        return (new ChildsCollection($this->newQueryFactoryInstance(), $this->categories))
            ->get();
    }
    public function price(){
        return new Price($this->newQueryFactoryInstance());
    }


    private function newQueryFactoryInstance()
    {
        return new QueryFactory($this);
    }

    public function __get($name)
    {
        return $this->category->{$name};
    }

    public function __invoke()
    {
        return $this->category;
    }
}