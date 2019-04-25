<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterItem extends Model
{
    protected $fillable = [
        'filter_id', 'en_name', 'ar_name', 'it_name', 'ru_name', 'sort_order'
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_filter_items');
    }

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }
}
