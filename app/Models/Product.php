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
        'recommended',
        'popular',
        'top',
    ];
    protected $casts = [
        'date_available' => 'date'
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
        return $this->belongsToMany(FilterItem::class, 'product_filter_items');
    }

    public function productFilterList()
    {
        return array_column($this->productFilters()->get()->toArray(), 'id');
    }

    /**
     * @param * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $field
     * @param string|null $table
     */
    public function scopeHome($query, $field, $table = null)
    {
        $query->where($table . $field, 1)
            ->where($table . 'status', 1)
            ->orderBy($table . 'sort_order');
    }

    public static function recommendationProducts()
    {
        return (new static)
            ->home('recommended')
            ->get()
            ->all();
    }

    public static function popularProducts()
    {
        return (new static)
            ->home('popular')
            ->get()
            ->all();
    }

    public static function topProducts()
    {
        return (new static)
            ->home('top')
            ->get()
            ->all();
    }
}
