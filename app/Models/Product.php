<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'vendor_id',
        'category_id',
        'brand_id',
        'en_name',
        'ar_name',
        'it_name',
        'ru_name',
        'sort_order',
        'status',
        'model',
        'img',
        'price',
        'quantity',
        'min_quantity',
        'shipping',
        'date_available',
    ];
    protected $casts = [
        'date_available' => 'data'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function meta()
    {
        return $this->hasOne(ProductMetaTag::class);
    }

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function description()
    {
        return $this->hasOne(ProductDescription::class);
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'product_filter');
    }

    public function productFilters()
    {
        return $this->hasMany(ProductFilter::class);
    }
}
