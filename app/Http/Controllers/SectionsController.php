<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SectionsController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = "/images/sections/";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('admin.sections.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all()['section'];
        $this->validator($data);
        image($data['basic'], 'banner_img', $this->path, function ($file) use (&$data) {
            $file->upload($data['basic']);
        });
        image($data['basic'], 'home_img', $this->path, function ($file) use (&$data) {
            $file->thumb('thumb', 500)
                ->upload($data['basic']);
        });
        try {

            $section = Section::create($data['basic']);
            $section->brands()->sync($data['brand']);
            $section->detail()->create($data['details']);
            return redirect()->route('admin.sections.index')->with('success', 'Section has been inserted');
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
     * @param  Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $brands = Brand::all();
        return view('admin.sections.edit', compact('section', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $attributes = $request->all()['section'];
        $this->validator($attributes);
        image($attributes['basic'], 'banner_img', $this->path, function ($image) use (&$attributes, $section) {
            $image->current($section->banner_img)
                ->upload($attributes['basic']);
        });
        image($attributes['basic'], 'home_img', $this->path, function ($image) use (&$attributes, $section) {
            $image->current($section->home_img)
                ->thumb('thumb', 500)
                ->upload($attributes['basic']);
        });
        try {

            $section->update($attributes['basic']);
            $section->brands()->sync($attributes['brand']);
            $section->detail()->update($attributes['details']);
            return redirect()->route('admin.sections.index')->with('success', 'Section has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Section has been deleted');
    }

    /**
     * @param array $data
     * @param null|integer $id
     * @return mixed
     */
    private function validator(array $data, $id = null)
    {
        return Validator::make($data, $this->rules($id))->validate();

    }

    /**
     * @param null|integer $id
     * @return array
     */
    private function rules($id = null)
    {
        $rules = [
            'basic.en_name' => ['required', Rule::unique('filters', 'en_name')->ignore($id)],
            'basic.ar_name' => ['required', Rule::unique('filters', 'ar_name')->ignore($id)],
            'basic.ru_name' => ['required', Rule::unique('filters', 'ru_name')->ignore($id)],
            'basic.it_name' => ['required', Rule::unique('filters', 'it_name')->ignore($id)],
            'basic.status' => 'required|boolean',
            'basic.sort_order' => 'required|integer',
            'basic.banner_img' => 'nullable|image',
            'basic.home' => 'required|boolean',
            'basic.home_sort_order' => 'integer|nullable',
            'basic.home_img' => 'nullable|file',
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
        ];
        return $rules;
    }
}
