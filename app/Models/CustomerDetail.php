<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    protected $fillable = [
        'customer_id',
        'hotel_id',
        'room_no',
        'street',
        'address',
        'city',
        'country',
        'phone',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function location()
    {
        if ($this->hotel()->exists()) {
            return $this->hotel()->first();
        }
        return $this;
    }
}
