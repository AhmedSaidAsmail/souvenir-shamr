<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterItem extends Model
{
    protected $fillable = [
        'filter_id', 'en_name', 'ar_name', 'it_name', 'ru_name', 'sort_order'
    ];
}
