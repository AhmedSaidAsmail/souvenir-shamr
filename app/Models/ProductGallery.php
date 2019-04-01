<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = [
        'product_id', 'image', 'sort_order', 'filter_item_id'
    ];

    public function filterItem()
    {
        return $this->belongsTo(FilterItem::class);
    }
}
