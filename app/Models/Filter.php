<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $fillable = [
        'en_name', 'ar_name', 'it_name', 'ru_name', 'sort_order', 'status'
    ];

    public function items()
    {
        return $this->hasMany(FilterItem::class);
    }

    public function ProductItems($product_id)
    {
        return $this->hasMany(ProductFilterItem::class)->where('product_id', $product_id);
    }

    public function delete()
    {
        parent::delete();
        $this->items()->delete();
    }
}
