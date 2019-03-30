<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $vendors = Vendor::all();
        // to remove later
        $brands = Brand::all();
        $filters = Filter::all();
        return view('admin.products.create', compact('categories', 'vendors', 'brands', 'filters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBrands($category = null)
    {
        $brands = Category::find($category)->allBrands();
        return view('admin.products.layouts.brands', compact('brands'));
    }

    public function getFilters($category = null)
    {
        $filters = Category::find($category)->filters()->get();
        return view('admin.products.layouts.filters', compact('filters'));
    }

    public function getFilterItems($filter)
    {
        $filter = Filter::find($filter);
        return view('admin.products.layouts.filters_items', compact('filter'));
    }
}
