<?php

namespace App\Src\Payment;

use Illuminate\Http\Request;

class PaymentFactory
{
    public static function makePayment(Request $request)
    {
        switch ($request->get('payment_method')) {
            case "payment_gateway":
                return new CreditGateway($request);
            case "paypal":
                return new PaypalGateway($request);
            default:
                return new CashOnDelivery($request);
        }

    }

}