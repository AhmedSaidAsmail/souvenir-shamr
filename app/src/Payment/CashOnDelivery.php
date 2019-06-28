<?php

namespace App\Src\Payment;


class CashOnDelivery extends AbstractPaymentGateway
{

    /**
     * Determine if payment setting is exists
     *
     * @return boolean
     * @throws \App\Src\Payment\Exceptions\SettingNotExistsException
     */
    protected function settingIsExists()
    {
        return true;
    }

    /**
     * @param array $charge
     * @return PaymentResponse
     * @throws \App\Src\Payment\Exceptions\PaymentGatewayException
     */
    protected function makeResponse(array $charge = [])
    {
        return PaymentResponse::makeResponse(
            $charge['link'],
            false,
            "CashOnDelivery"
        );
    }

    /**
     * Proceed payment and generate redirect link
     *
     * @return PaymentResponse
     * @throws \App\Src\Payment\Exceptions\PaymentGatewayException
     */
    public function proceed()
    {
        if ($this->settingIsExists()) {
            $charge = [];
            $charge['link'] = $this->redirectLink;
            return $this->makeResponse($charge);
        }

    }
}