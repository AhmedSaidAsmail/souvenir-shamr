<?php

namespace App\Src\Payment;


class PaymentResponse
{
    /**
     * Determine payment is success or not
     *
     * @var boolean $status
     */
    public $status;
    /**
     * PaymentGateway Transaction ID if exists
     *
     * @var null|integer $transaction_id
     */
    public $transaction_id;

    /**
     * PaymentResponse constructor.
     * @param boolean $status
     * @param null|integer $transaction_id
     */
    public function __construct($status, $transaction_id = null)
    {
        $this->status = $status;
        $this->transaction_id = $transaction_id;
    }

    /**
     * @param boolean $status
     * @param null|integer $transaction_id
     * @return PaymentResponse
     */
    public static function makeResponse($status, $transaction_id = null)
    {
        return new self($status, $transaction_id);
    }
}