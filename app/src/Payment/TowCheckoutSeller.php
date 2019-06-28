<?php

namespace App\Src\Payment;

use Illuminate\Http\Request;

class TowCheckoutSeller
{
    /**
     * Providing Seller information array
     *
     * @param Request $request
     * @return array
     */
    public static function seller(Request $request)
    {
        return [
            'merchantOrderId' => md5(uniqid(rand(), true)),
            'token' => $request->get('token'),
            'currency' => strtoupper(currency()),
            'total' => cart()->total(),
            'billingAddr' => self::customerAddress(),
        ];
    }

    /**
     * Providing Customer information array
     *
     * @return array
     */
    private static function customerAddress()
    {
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