<?php

namespace App\Repositories;


use App\Src\Payment\PaymentFactory;
use Illuminate\Http\Request;

class Checkout
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function all(){
        $factory=PaymentFactory::makePayment($this->request);
        return $factory->proceed();
    }

}