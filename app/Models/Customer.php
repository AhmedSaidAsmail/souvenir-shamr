<?php

namespace App\Models;

use App\User;

class Customer extends User
{
    public function details()
    {
        return $this->hasOne(CustomerDetail::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class);
    }

}
