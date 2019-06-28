<?php

namespace App\Src\Payment;


use App\Models\PaypalPaymentGateway;
use App\Src\Payment\Exceptions\SettingNotExistsException;
use App\Src\Payment\Exceptions\PaymentGatewayException;
use Exception;

class PaypalGateway extends AbstractPaymentGateway
{
    /**
     * @var \App\Models\PaypalPaymentGateway
     */
    private $setting;

    /**
     * Proceed payment and generate redirect link
     *
     * @return PaymentResponse
     * @throws \App\Src\Payment\Exceptions\PaymentGatewayException
     */
    public function proceed()
    {
        if ($this->settingIsExists()) {
            try {
                $link = (new PaypalSdkBuilder($this->setting, $this->redirectLink))
                    ->preparePaymentLink();
                return $this->makeResponse(['link' => $link]);
            } catch (Exception $exception) {
                throw new PaymentGatewayException($exception->getMessage());
            }
        }
    }

    /**
     * Determine if payment setting is exists
     *
     * @return boolean
     * @throws \App\Src\Payment\Exceptions\SettingNotExistsException
     */
    protected function settingIsExists()
    {
        if ($this->setting = PaypalPaymentGateway::setting()) {
            return true;
        }
        throw new SettingNotExistsException('Payment Gateway setting not exists');
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
            "paypal");
    }
}