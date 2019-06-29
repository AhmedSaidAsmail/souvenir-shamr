<?php

namespace App\Http\Controllers;

use App\Models\CreditPaymentGateway;
use App\Models\PaypalPaymentGateway;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function welcome()
    {
        return view('admin.welcome');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function payment()
    {
        $paypal = PaypalPaymentGateway::setting();
        $paymentGateway = CreditPaymentGateway::setting();
        return view('admin.payment', compact('paypal', 'paymentGateway'));
    }
}
