<?php

namespace App\Src\Payment;


class PaypalGateway extends AbstractPaymentGateway
{

    /**
     * Proceed payment and generate redirect link
     *
     * @return string
     */
    function proceed()
    {
        // TODO: Implement proceed() method.
    }

    /**
     * Determine if payment setting is exists
     *
     * @return boolean
     * @throws \App\Src\Payment\Exception\SettingNotExistsException
     */
    function settingIsExists()
    {
        // TODO: Implement settingIsExists() method.
    }
}