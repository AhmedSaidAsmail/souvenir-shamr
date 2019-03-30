<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    protected $table = "product_filter";
    protected $fillable = [
        'product_id', 'filter_id'
    ];

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }

    public function items()
    {
        return $this->hasMany(ProductFilterItem::class,'filter_id','filter_id');
    }
}
