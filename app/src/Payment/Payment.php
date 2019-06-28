<?php

namespace App\Src\Payment;

use App\Src\Payment\Exceptions\PaymentGatewayException;
use Exception;
use Illuminate\Http\Request;

class Payment implements PaymentMethodInterface
{
    private $request;
    private $redirectLink;

    public function __construct(Request $request, $redirectLink)
    {
        $this->request = $request;
        $this->redirectLink = $redirectLink;
    }

    /**
     * @return PaymentMethodInterface
     */
    private function paymentGatewayInstance()
    {
        return PaymentFactory::makePayment($this->request, $this->redirectLink);
    }

    /**
     * Proceed payment and generate redirect link
     *
     * @return PaymentResponse
     * @throws \App\Src\Payment\Exceptions\PaymentGatewayException
     */
    public function proceed()
    {
        try {
            return $this->paymentGatewayInstance()->proceed();
        } catch (Exception $exception) {
            throw new PaymentGatewayException($exception->getMessage());
        }
    }
}