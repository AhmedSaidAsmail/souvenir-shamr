<?php

namespace App\Src\Payment;


use Illuminate\Http\Request;

abstract class AbstractPaymentGateway implements PaymentMethodInterface
{
    /**
     * @var Request $request
     */
    protected $request;
    /**
     * @var string $redirectLink
     */
    protected $redirectLink;

    /**
     * AbstractPaymentGateway constructor.
     * @param Request $request
     * @param string $redirectLink
     */
    public function __construct(Request $request,$redirectLink)
    {
        $this->request = $request;
        $this->redirectLink=$redirectLink;
    }

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
   abstract protected function makeResponse(array $charge=[]);

}