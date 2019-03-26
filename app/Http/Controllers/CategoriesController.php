<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        $categories = Category::all();
        $filters = Filter::all();
        $brands = Brand::all();
        return view('admin.categories.create', compact('sections', 'categories', 'filters','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all()['category'];
        $this->prepareSection($attributes);
        $this->validator($attributes);
        try {
            $category = Category::create($attributes['basic']);
            $category->detail()->create($attributes['details']);
            $category->syncLink($attributes['link']);
            $category->brands()->sync($attributes['brands']);
            $category->filters()->sync($attributes['filters']);
            return redirect()->route('admin.categories.index')->with('success', 'Category has been inserted');

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
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        dd($category->children()->get());
//        $all=$category->allChildren();
//       foreach ($all as $cat){
//           echo $cat->id.'<br>';
//       }
//        dd($category->children()->get()->toArray());
//        $sections = Section::all();
//        $categories = Category::where('id', "<>", $category->id)->get();
//        $filters = Filter::all();
//        return view('admin.categories.edit', compact('category', 'sections', 'categories', 'filters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $attributes = $request->all()['category'];
        $this->prepareSection($attributes);
        $this->validator($attributes, $category->id);
        try {
            $category->update($attributes['basic']);
            $category->detail()->create($attributes['details']);
            $category->syncLink($attributes['link']);
            $category->brands()->sync($attributes['brands']);
            $category->filters()->sync($attributes['filters']);
            return redirect()->route('admin.categories.index')->with('success', 'Category has been updated');

        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
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

    /**
     * @param Request $request
     * @param null|integer $category_id
     * @return \Illuminate\Http\Response
     */
    public function getBrands(Request $request, $category_id = null)
    {
        $brands = null;
        if ($section = $request->get('section')) {
            $brands = Section::find($section)->brands;
        } elseif ($selected_category = $request->get('category')) {
            $brands = Category::find($selected_category)->section->brands;
        }
        $category = !is_null($category_id) ? Category::find($category_id) : null;
        return view('admin.categories.layouts.brands', compact('brands', 'category'));
    }

    /**
     * @param array $attributes
     * @param null $id
     * @return mixed
     */
    protected function validator(array $attributes, $id = null)
    {
        return Validator::make($attributes, [
            'basic.section_id' => 'required|integer',
            'basic.parent_id' => 'required_without:basic.section_id|integer|nullable',
            'basic.en_name' => ['required', Rule::unique('categories', 'en_name')->ignore($id)],
            'basic.ar_name' => ['required', Rule::unique('categories', 'en_name')->ignore($id)],
            'basic.ru_name' => ['required', Rule::unique('categories', 'en_name')->ignore($id)],
            'basic.it_name' => ['required', Rule::unique('categories', 'en_name')->ignore($id)],
            'basic.status' => 'required|boolean',
            'basic.sort_order' => 'required|integer',
            'basic.home' => 'required|boolean',
            'basic.home_sort_order' => 'required|integer',
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
            // Brands
            'brands.*' => ['required', Rule::exists('brand_section', 'brand_id')->where(function ($query) use ($attributes) {
                $query->where('section_id', $attributes['basic']['section_id']);
            })],
            //Filters
            'filters.*' => 'required:integer|exists:filters,id',
            // links
            'link.header_1' => 'string',
            'link.header_2' => 'string',
            'link.link' => 'string',
        ])->validate();

    }

    /**
     * Prepare Section id for the attributes
     *
     * @param array $attributes
     */
    private function prepareSection(array &$attributes)
    {
        if (!isset($attributes['basic']['section_id']) && $parent_id = $attributes['basic']['parent_id']) {
            $attributes['basic']['section_id'] = Category::find($parent_id)->section->id;
        }
    }
}
