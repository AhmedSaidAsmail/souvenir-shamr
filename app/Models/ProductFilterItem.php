<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFilterItem extends Model
{
    protected $fillable = [
        'product_id', 'filter_id', 'filter_item_id', 'sort_order'
    ];

    public function images()
    {
        return $this->hasMany(ProductFilterItemGallery::class);
    }

    public function item()
    {
        return $this->belongsTo(FilterItem::class, 'filter_item_id');
    }
}
