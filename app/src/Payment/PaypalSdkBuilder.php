<?php

namespace App\Src\Payment;

use App\Models\PaypalPaymentGateway;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment as PaypalPayment;
use PayPal\Api\RedirectUrls;
use App\Src\Payment\Exceptions\PaymentGatewayException;

class PaypalSdkBuilder
{
    /**
     * @var Payer $payer
     */
    private $payer;
    /**
     * @var Details $details
     */
    private $details;
    /**
     * @var Amount $amount
     */
    private $amount;
    /**
     * @var Transaction $transaction
     */
    private $transaction;
    /**
     * @var PaypalPayment $payment
     */
    private $payment;
    /**
     * @var RedirectUrls $redirectUrls
     */
    private $redirectUrls;
    /**
     * @var ApiContext $api
     */
    private $api;
    /**
     * @var PaypalPaymentGateway
     */
    private $setting;
    /**
     * @var string $redirectLink
     */
    private $redirectLink;

    /**
     * PaypalSdkBuilder constructor.
     * @param PaypalPaymentGateway $paypal_setting
     * @param string $redirectLink
     */
    public function __construct(PaypalPaymentGateway $paypal_setting, $redirectLink)
    {
        $this->setting = $paypal_setting;
        $this->redirectLink = $redirectLink;
        $this->initSdk();
    }

    /**
     * Initial Paypal Sdk
     *
     */
    private function initSdk()
    {
        $this->payer = new Payer();
        $this->details = new Details();
        $this->amount = new Amount();
        $this->transaction = new Transaction();
        $this->payment = new PaypalPayment();
        $this->redirectUrls = new RedirectUrls();
    }

    private function successLink()
    {
        return PaymentResponse::makeResponse($this->redirectLink, true, "paypal")
            ->getRedirectLinkWithAttributes();
    }

    private function cancelLink()
    {
        return PaymentResponse::makeResponse($this->redirectLink, false, "paypal")
            ->getRedirectLinkWithAttributes();
    }

    /**
     * Preparing Paypal Api
     *
     * @return $this
     */

    private function setApi()
    {
        $this->api = new ApiContext(
            new OAuthTokenCredential($this->setting->client_id, $this->setting->secret)
        );
        return $this;
    }

    /**
     * Setting the config
     *
     * @param ApiContext $api
     * @return $this
     */
    private function setConfig(ApiContext $api)
    {
        $api->setConfig([
            'mode' => $this->setting->sandbox ? "sandbox" : "live",
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => false,
            'log.LogFileName' => '',
            'log.LogLevel' => 'fine',
            'validation.level' => 'log'
        ]);
        return $this;
    }

    /**
     * Setting PayPal Payer
     *
     * @return $this
     */
    private function setPayer()
    {
        $this->payer->setPaymentMethod('paypal');
        return $this;
    }

    /**
     * Setting Payment Details
     *
     * @return $this
     */
    private function setDetails()
    {
        $this->details
            ->setTax(0)
            ->setShipping(0)
            ->setSubtotal(cart()->total());
        return $this;
    }

    /**
     * Setting the amount and currency and payment details
     *
     * @return $this
     */
    private function setAmount()
    {
        $this->amount
            ->setTotal(cart()->total())
            ->setCurrency(strtoupper(currency()))
            ->setDetails($this->details);
        return $this;
    }

    /**
     * Setting PayPal Transaction
     *
     * @return $this
     */
    private function setTransaction()
    {
        $this->transaction
            ->setAmount($this->amount)
            ->setDescription($this->setting->description);
        return $this;
    }

    /**
     * Doing Payment
     *
     * @return $this
     */
    private function setPayment()
    {
        $this->payment->setIntent('sale')
            ->setPayer($this->payer)
            ->setTransactions([$this->transaction]);
        return $this;
    }


    /**
     * Making the success redirect link
     *
     * @return $this
     */
    private function setRedirect()
    {
        // set the redirect url object
        $this->redirectUrls
            ->setReturnUrl($this->successLink())
            ->setCancelUrl($this->cancelLink());
        // injecting redirect url object to payment object
        $this->payment
            ->setRedirectUrls($this->redirectUrls);
        return $this;
    }

    /**
     * @return void
     * @throws \RuntimeException
     */
    private function createApi()
    {
        $this->payment->create($this->api);
    }

    /**
     * Configure the PayPal Api
     *
     *
     */
    private function buildSdk()
    {
        $this->setApi()
            ->setConfig($this->api)
            ->setPayer()
            ->setDetails()
            ->setAmount()
            ->setTransaction()
            ->setPayment()
            ->setRedirect()
            ->createApi();

    }

    /**
     * @return string Paypal Redirect Link
     * @throws PaymentGatewayException
     */
    public function preparePaymentLink()
    {
        try {
            $this->buildSdk();
            foreach ($this->payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirectUrl = $link->getHref();
                    return $redirectUrl;
                }
            }
        } catch (\Exception $e) {
            throw new PaymentGatewayException($e->getMessage());
        }
    }

}