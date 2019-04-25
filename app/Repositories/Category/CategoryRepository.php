<?php

namespace App\Repositories\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

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
    /**
     * @var \Illuminate\Database\Query\Builder
     */
    private $query;

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
        return (new Products($this->newQueryInstance()))->get($limit, $offset);
    }

    public function filters()
    {
        return (new Filters($this->newQueryInstance()))->get();
    }

    public function brands()
    {
        return (new Brands($this->newQueryInstance()))->get();
    }

    public function childs()
    {
        return (new Childs($this->categories, $this->newQueryInstance()))->get();

//        return $this->query
//            ->select('products.id')
//            ->distinct('products.id')
//            ->where('categories.id', '=', 7)
//            ->get()
//            ->count();

////        return (new QueryFactory($this))
////            ->makeQuery(4)
////            ->select('products.id')
////            ->distinct('products.id')
////            ->get()
////            ->count();
//        return $this->query
//            ->select('products.id')
//            ->distinct('products.id')
//            ->where('categories.id', '=', 7)
////            ->select('categories.id', 'products.id as product', DB::raw('count(products.id) as count'))
////            ->distinct('products.id')
////            //->distinct('product_id')
////            ->groupBy('categories.id')
////            ->groupBy('products.id')
//////            ->select('categories.id','products.id as product',DB::raw('count(products.id) as count'))
//////            ->groupBy('products.id')
////////            ->select('categories.id',DB::raw('count(products.id) as count'))
//////            ->groupBy('categories.id')
//            ->get()
//            ->count();
    }

    private function newQueryInstance()
    {
        return (new QueryFactory($this))->makeQuery();
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