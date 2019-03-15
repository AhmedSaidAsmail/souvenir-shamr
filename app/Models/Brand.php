<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'en_name', 'ar_name', 'it_name', 'ru_name', 'sort_order', 'status'
    ];
}
