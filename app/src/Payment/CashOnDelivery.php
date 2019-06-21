<?php
/**
 * Created by PhpStorm.
 * User: infom
 * Date: 6/21/2019
 * Time: 1:57 AM
 */

namespace App\Src\Payment;


class CashOnDelivery extends AbstractPaymentGateway
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