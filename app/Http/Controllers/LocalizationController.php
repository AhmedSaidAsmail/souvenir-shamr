<?php

namespace App\Http\Controllers;

use App\Models\Localization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class LocalizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localizations=Localization::all();
        return view('admin.localizations.index',compact('localizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.localizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);
        try {
            Localization::create($request->all());
            return redirect()->route('admin.localization.index')->with('success', 'New Translating has been set');
        } catch (Exception $exception) {
            return redirect()->back()->with('failure', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localization=Localization::findOrFail($id);
        return view('admin.localizations.edit',compact('localization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $localization=Localization::findOrFail($id);
        $this->validator($request);
        try {
            $localization->update($request->all());
            return redirect()->route('admin.localization.index')->with('success', 'New Translating has been set');
        } catch (Exception $exception) {
            return redirect()->back()->with('failure', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localization=Localization::findOrFail($id);
        try {
            $localization->delete();
            return redirect()->route('admin.localization.index')->with('success', 'Translating has been deleted');
        } catch (Exception $exception) {
            return redirect()->back()->with('failure', $exception->getMessage());
        }

    }
    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'word' => 'required|string',
            'word_en' => 'required|string',
            'word_ar' => 'required|string',
            'word_ru' => 'required|string',
            'word_it' => 'required|string',
        ])->validate();
    }
}
