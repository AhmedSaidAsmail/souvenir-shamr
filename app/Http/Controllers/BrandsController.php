<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validator($data['brand']);
        try {
            Brand::create($data['brand']);
            return redirect()->route('admin.brands.index')->with('success', 'Brand has been inserted');
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $data = $request->all();
        $this->validator($data['brand'], $brand->id);
        try {
            $brand->update($data['brand']);
            return redirect()->route('admin.brands.index')->with('success', 'Brand has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand has been deleted');
    }

    /**
     * @param array $data
     * @param null|integer $id
     * @return mixed
     */
    private function validator(array $data, $id = null)
    {
        return Validator::make($data, [
            'en_name' => ['required', Rule::unique('brands')->ignore($id)],
            'ar_name' => ['required', Rule::unique('brands')->ignore($id)],
            'ru_name' => ['required', Rule::unique('brands')->ignore($id)],
            'it_name' => ['required', Rule::unique('brands')->ignore($id)],
            'status' => 'required|boolean',
            'sort_order' => 'required|integer',
        ])->validate();

    }
}
