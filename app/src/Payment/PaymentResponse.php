<?php

namespace App\Src\Payment;


class PaymentResponse
{
    /**
     * Determine payment is success or not
     *
     * @var boolean $payment_approval
     */
    public $payment_approval;
    /**
     * Determine which payment method was used
     *
     * @var string $payment_method
     */
    public $payment_method;
    /**
     * PaymentGateway Transaction ID if exists
     *
     * @var null|integer $transactionID
     */
    public $transaction_id;
    /**
     * @var string|null $redirectLink
     */
    public $redirectLink;

    /**
     * PaymentResponse constructor.
     * @param string $redirectLink
     * @param boolean $payment_approval
     * @param string $payment_method
     * @param null|integer $transaction_id
     */
    public function __construct($redirectLink, $payment_approval, $payment_method, $transaction_id = null)
    {
        $this->redirectLink = $redirectLink;
        $this->payment_approval = $payment_approval;
        $this->payment_method = $payment_method;
        $this->transaction_id = $transaction_id;
    }


    public function getRedirectLink()
    {
        return $this->redirectLink;
    }

    public function getRedirectLinkWithAttributes()
    {
        return rtrim($this->redirectLink, "/") . "/?" . http_build_query([
                'approval' => json_encode($this->payment_approval),
                'method' => $this->payment_method
            ]);
    }

    /**
     * @param string $redirectLink
     * @param boolean $payment_approval
     * @param string $payment_method
     * @param null|integer $transaction_id
     * @return PaymentResponse
     */
    public static function makeResponse($redirectLink, $payment_approval, $payment_method, $transaction_id = null)
    {
        return new self($redirectLink, $payment_approval, $payment_method, $transaction_id);
    }

    public function __toArray()
    {
        return [
            'transaction_id' => $this->transaction_id,
            'payment_method' => $this->payment_method,
            'payment_approval' => $this->payment_approval
        ];
    }
}