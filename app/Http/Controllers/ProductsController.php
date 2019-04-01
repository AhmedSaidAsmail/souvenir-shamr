<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = "/images/products/";
    }

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
        return view('admin.products.create', compact('categories', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all()['product'];
        $this->validator($attributes);
        image($attributes['basic'], 'img', $this->path, function ($file) use (&$attributes) {
            $file->thumb('thumb', 500)
                ->upload($attributes['basic']);
        });
        multipleImage($attributes['gallery'], 'image', $this->path, function ($file) {
            $file->thumb('thumb', 500)
                ->upload();
            return $file->image_name;
        });
        try {
            /**
             * @var Product $product
             */
            $product = Product::create($attributes['basic']);
            $product->meta()->create($attributes['details']);
            $product->description()->create($attributes['description']);
            $product->gallery()->createMany($attributes['gallery']);
            $product->filters()->sync($attributes['filters']);
            $product->productFilters()->sync($this->flattenFiltersArray($attributes['filter_items']));
            return redirect()->route('admin.products.index')->with('success', 'Product has successfully created');

        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
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
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $vendors = Vendor::all();
        return view('admin.products.edit', compact('categories', 'vendors', 'product'));
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

    private function validator(array $attributes, $id = null)
    {
        return Validator::make($attributes, [
            'basic.category_id' => 'required|integer|exists:categories,id',
            'basic.brand_id' => 'required|integer|exists:brands,id',
            'basic.vendor_id' => 'required|integer|exists:vendors,id',
            'basic.en_name' => ['required', Rule::unique('products', 'en_name')->ignore($id)],
            'basic.ar_name' => ['required', Rule::unique('products', 'en_name')->ignore($id)],
            'basic.ru_name' => ['required', Rule::unique('products', 'en_name')->ignore($id)],
            'basic.it_name' => ['required', Rule::unique('products', 'en_name')->ignore($id)],
            'basic.status' => 'boolean|required',
            'basic.sort_order' => 'required|integer',
            'basic.price' => 'required|integer|min:1',
            'basic.shipping' => 'boolean|required',
            'basic.quantity' => 'required|integer|min:1',
            'basic.min_quantity' => 'required|integer',
            'basic.date_available' => 'required|date',
            'basic.img' => 'required|image',
            // Meta tags
            'details.en_meta_title' => 'required|string',
            'details.ar_meta_title' => 'required|string',
            'details.ru_meta_title' => 'required|string',
            'details.it_meta_title' => 'required|string',
            'details.en_meta_keywords' => 'required|string',
            'details.ar_meta_keywords' => 'required|string',
            'details.it_meta_keywords' => 'required|string',
            'details.ru_meta_keywords' => 'required|string',
            'details.en_meta_description' => 'required|string',
            'details.ar_meta_description' => 'required|string',
            'details.it_meta_description' => 'required|string',
            'details.ru_meta_description' => 'required|string',
            // descriptions
            'description.en_description' => 'required|string',
            'description.ar_description' => 'required|string',
            'description.ru_description' => 'required|string',
            'description.it_description' => 'required|string',
            // filters
            'filters.*.filter_id' => 'required|integer|exists:filters,id',
            // filter items
            'filter_items.*.*' => 'integer|exists:filter_items,id',
            // gallery
            'gallery.*.image' => 'image'
        ])->validate();

    }

    protected function flattenFiltersArray($filters)
    {
        $result = [];
        array_walk($filters, function ($filter) use (&$result) {
            $result = array_merge($result, $filter);
        });
        return $result;
    }
}
