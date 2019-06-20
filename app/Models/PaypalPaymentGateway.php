<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaypalPaymentGateway extends Model
{
    protected $fillable = [
        'client_id', 'secret', 'description', 'sandbox'
    ];

    public static function setting()
    {
        return (new self)->first();
    }
}
