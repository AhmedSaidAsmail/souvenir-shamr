<?php

namespace App\Repositories\Category;

use Illuminate\Http\Request;

class Categories
{

    /**
     * @param Request $request
     * @param $id
     * @return CategoryRepository
     */
    public static function find(Request $request, $id)
    {
        return new CategoryRepository($request, $id);
    }


}