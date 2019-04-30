<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFilterItem extends Model
{
    protected $table = 'product_filter_items';
    protected $fillable = [
        'product_id',
        'filter_item_id'
    ];
    public function item(){
        return $this->belongsTo(FilterItem::class,'filter_item_id');
    }
}
