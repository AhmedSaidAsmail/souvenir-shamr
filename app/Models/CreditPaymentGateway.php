<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditPaymentGateway extends Model
{
    protected $fillable = [
        'partner_id', 'public_key', 'private_key', 'ssl', 'sandbox'
    ];

    public static function setting()
    {
        return (new self)->first();
    }
}
