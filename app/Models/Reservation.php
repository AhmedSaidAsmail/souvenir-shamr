<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'unique_id',
        'customer_id',
        'transaction_id',
        'order_number',
        'payment_method',
        'payment_approval',
        'total',
        'currency',
        'archive'
    ];

    public function items()
    {
        return $this->hasMany(ReservationItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
