<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FiltersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Filter::all();
        return view('admin.filters.index', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.filters.create');
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
        $this->validator($data['filters']);
        try {
            $filters = Filter::create($data['filters']['basic']);
            if (isset($data['filters']['items'])) {
                $filters->items()->createMany($data['filters']['items']);
            }
            return redirect()->route('admin.filters.index')->with('success', 'Filters has been inserted');
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
     * @param  Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        return view('admin.filters.edit', compact('filter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filter $filter)
    {
        $data = $request->all();
        $this->validator($data['filters'], $filter->id);
        $items = isset($data['filters']['items']) ? $data['filters']['items'] : [];
        try {
            $filter->update($data['filters']['basic']);
            resolve('sync')
                ->setAttributes($filter->items(), $items)
                ->sync();
            return redirect()->route('admin.filters.index')->with('success', 'Filters has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Filter $filter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filter $filter)
    {
        $filter->delete();
        return redirect()->route('admin.filters.index')->with('success', 'Filters has been deleted');
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
            'items.*.en_name' => 'required',
            'items.*.ar_name' => 'required',
            'items.*.ru_name' => 'required',
            'items.*.it_name' => 'required',
            'items.*.sort_order' => 'required|integer',
        ];
        return $rules;
    }

//    private function flattenArrayWithRules(array $data, $prefix, $target, $rules, &$return = [])
//    {
//        foreach ($data as $key => $value) {
//            if (is_array($value)) {
//                $this->flattenArrayWithRules($value, $prefix . "." . $key, $target, $rules, $return);
//            } else {
//                if ($key == $target) {
//                    $return[$prefix . "." . $key] = $rules;
//                }
//            }
//        }
//        return $return;
//    }
}
