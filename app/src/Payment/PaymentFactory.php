<?php

namespace App\Src\Payment;

use Illuminate\Http\Request;

class PaymentFactory
{
    /**
     * @param Request $request
     * @param $redirectLink
     * @return PaymentMethodInterface
     */
    public static function makePayment(Request $request,$redirectLink)
    {
        switch ($request->get('payment_method')) {
            case "payment_gateway":
                return new CreditGateway($request,$redirectLink);
            case "paypal":
                return new PaypalGateway($request,$redirectLink);
            default:
                return new CashOnDelivery($request,$redirectLink);
        }

    }

}