<?php

namespace App\Models;

use App\User;

class Customer extends User
{
    public function details()
    {
        return $this->hasOne(CustomerDetail::class);
    }

}
