<?php

namespace App\Http\Controllers;

use App\Models\CustomerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class CustomerDetailsController extends Controller
{
    public function store(Request $request, $lang)
    {
        $attributes = $request->all();
        $this->validator($attributes);
        try {
            auth()->guard('customer')
                ->user()
                ->details()
                ->create($attributes);
            return redirect()->route('cart.payment', compact('lang'));
        } catch (Exception $exception) {
            return back()->with('failure', $exception->getMessage());

        }
    }
    public function update(Request $request, $lang,$address_id)
    {
        $attributes = $request->all();
        $this->validator($attributes);
        try {
            CustomerDetail::find($address_id)->update($attributes);
            return redirect()->route('cart.payment', compact('lang'));
        } catch (Exception $exception) {
            return back()->with('failure', $exception->getMessage());

        }
    }

    private function validator(array $attributes)
    {
        return Validator::make($attributes, [
            'phone' => 'required|string',
            'hotel_id' => 'required_without:address|integer',
            'room_no' => 'required_with:hotel_id|integer',
            'address' => 'required_without:hotel_id|string'
        ])->validate();
    }
}
