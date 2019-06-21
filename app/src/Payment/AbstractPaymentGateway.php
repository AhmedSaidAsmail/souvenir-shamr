<?php

namespace App\Src\Payment;


use Illuminate\Http\Request;

abstract class AbstractPaymentGateway
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Proceed payment and generate redirect link
     *
     * @return PaymentResponse
     * @throws \App\Src\Payment\Exceptions\PaymentGatewayException
     */
    abstract public function proceed();

    /**
     * Determine if payment setting is exists
     *
     * @return boolean
     * @throws \App\Src\Payment\Exceptions\SettingNotExistsException
     */
    abstract protected function settingIsExists();
    /**
     * @param array $charge
     * @return PaymentResponse
     * @throws \App\Src\Payment\Exceptions\PaymentGatewayException
     */
   abstract protected function makeResponse(array $charge);

}