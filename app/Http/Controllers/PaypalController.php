<?php

namespace App\Http\Controllers;

use App\Models\PaypalPaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PaypalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);
        try {
            PaypalPaymentGateway::create($request->all());
            return redirect()->route('admin.settings.payment')->with('success', 'Paypal has benn set');
        } catch (Exception $exception) {
            return redirect()->route('admin.settings.payment')->with('failure', $exception->getMessage());
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
        $paypal=PaypalPaymentGateway::findOrFail($id);
        $this->validator($request);
        try {
            $paypal->update($request->all());
            return redirect()->route('admin.settings.payment')->with('success', 'Paypal has benn set');
        } catch (Exception $exception) {
            return redirect()->route('admin.settings.payment')->with('failure', $exception->getMessage());
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
        $paypal=PaypalPaymentGateway::findOrFail($id);
        try {
            $paypal->delete();
            return redirect()->route('admin.settings.payment')->with('success', 'Paypal has benn deleted');
        } catch (Exception $exception) {
            return redirect()->route('admin.settings.payment')->with('failure', $exception->getMessage());
        }
    }

    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'client_id' => 'required|string',
            'secret' => 'required|string',
            'description' => 'required|string',
            'sandbox' => 'required|boolean'
        ])->validate();
    }
}
