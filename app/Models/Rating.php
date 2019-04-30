<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'product_id',
        'customer_id',
        'rate',
        'title',
        'review',
        'confirm',
    ];
}
