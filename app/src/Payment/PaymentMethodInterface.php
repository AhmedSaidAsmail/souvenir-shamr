<?php

namespace App\Src\Payment;


interface PaymentMethodInterface
{
    /**
     * Proceed payment and generate redirect link
     *
     * @return PaymentResponse
     * @throws \App\Src\Payment\Exceptions\PaymentGatewayException
     */
    public function proceed();
}