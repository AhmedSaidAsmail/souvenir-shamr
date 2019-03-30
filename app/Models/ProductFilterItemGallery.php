<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFilterItemGallery extends Model
{
    protected $fillable = [
        'product_filter_item_id', 'image', 'sort_order'
    ];
}
