<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    protected $fillable = [
        'product_id', 'en_description', 'ar_description', 'it_description', 'ru_description'
    ];
}
