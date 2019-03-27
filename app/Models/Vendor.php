<?php

namespace App\Models;


use App\User;

class Vendor extends User
{
    protected $fillable=['email','name','password','confirm','rand_code'];
}
