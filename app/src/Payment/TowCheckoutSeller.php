<?php

namespace App\Src\Payment;

use Illuminate\Http\Request;

class TowCheckoutSeller
{
    public static function seller(Request $request)
    {
        return [
            //'sellerId' => $setting->partner_id,
            'merchantOrderId' => md5(uniqid(rand(), true)),
            'token' => $request->get('token'),
            'currency' => strtoupper(currency()),
            'total' => cart()->total(),
            'billingAddr' => self::customerAddress(),
            //'shippingAddr' => self::customerAddress()
        ];
    }

    private static function customerAddress()
    {
//        return [
//            'name' => auth()->guard('customer')->user()->name,
//            'email' => auth()->guard('customer')->user()->email,
//            'phone' => auth()->guard('customer')->user()->details->phone,
//            'address' => auth()->guard('customer')->user()->details->location()->address,
//            'city' => auth()->guard('customer')->user()->details->location()->city,
//            'state' => 'state',
//            'zipCode' => 'zipCode',
//            'country' => auth()->guard('customer')->user()->details->location()->country
//        ];
        return [
            "name" => auth()->guard('customer')->user()->name,
            "addrLine1" => "undefined",
            "city" => auth()->guard('customer')->user()->details->location()->city,
            "state" => 'undefined',
            "zipCode" => '43123',
            "country" => 'EG',
            "email" => auth()->guard('customer')->user()->email,
            "phoneNumber" => auth()->guard('customer')->user()->details->phone
        ];
    }
}