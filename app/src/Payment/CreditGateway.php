<?php

namespace App\Src\Payment;

use App\Models\CreditPaymentGateway;
use App\Src\Payment\Exceptions\PaymentGatewayException;
use App\Src\Payment\Exceptions\SettingNotExistsException;
use Exception;
use Twocheckout;
use Twocheckout_Charge;

class CreditGateway extends AbstractPaymentGateway
{
    /**
     * @var \App\Models\CreditPaymentGateway
     */
    private $setting;


    /**
     * Proceed payment and generate redirect link
     *
     * @return PaymentResponse
     * @throws PaymentGatewayException
     */
    public function proceed()
    {
        if ($this->settingIsExists()) {
            try {
                $charge = $this->twoCheckoutApiProcess();
                return $this->makeResponse($charge);
            } catch (Exception $exception) {
                throw new PaymentGatewayException($exception->getMessage());

            }
        }
    }

    /**
     * @return array
     * @throws PaymentGatewayException
     */
    private function twoCheckoutApiProcess()
    {
        try {
            Twocheckout::privateKey($this->setting->private_key);
            Twocheckout::sellerId($this->setting->partner_id);
            Twocheckout::verifySSL($this->settingIsVerifySSL());
            Twocheckout::sandbox($this->settingIsSandbox());
            return Twocheckout_Charge::auth(TowCheckoutSeller::seller($this->request));

        } catch (\Exception $e) {
            throw new PaymentGatewayException($e->getMessage());
        }

    }

    private function settingIsVerifySSL()
    {
        return $this->setting->ssl ? true : false;
    }

    private function settingIsSandbox()
    {
        return $this->setting->sandbox ? true : false;
    }

    /**
     * Determine if payment setting is exists
     *
     * @return boolean
     * @throws \App\Src\Payment\Exceptions\SettingNotExistsException
     */
    protected function settingIsExists()
    {
        if ($this->setting = CreditPaymentGateway::setting()) {
            return true;
        }
        throw new SettingNotExistsException('Payment Gateway setting not exists');
    }

    /**
     * @param array $charge
     * @return PaymentResponse
     * @throws PaymentGatewayException
     */
    protected function makeResponse(array $charge)
    {
        if ($approved = $charge['response']['responseCode'] == 'APPROVED') {
            return PaymentResponse::makeResponse(true, $charge['response']['orderNumber']);
        }
        throw new PaymentGatewayException('Payment is not approved');
    }
}