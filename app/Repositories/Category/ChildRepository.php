<?php


namespace App\Repositories\Category;


use App\Models\Category;
use Illuminate\Database\Query\Builder;

class ChildRepository
{
    private $category;
    private $builder;

    public function __construct(Category $category, Builder $builder)
    {
        $this->category = $category;
        $this->builder = $builder;
    }

    public function count()
    {
        return $this->builder
            ->select('products.id')
            ->distinct('products.id')
            ->where('categories.id', '=', $this->category->id)
            ->get()
            ->count();
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