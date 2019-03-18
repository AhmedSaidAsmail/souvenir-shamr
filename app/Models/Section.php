<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Section
 * @package App\Models
 * @method static Section create(array $attributes)
 */
class Section extends Model
{
    protected $fillable = [
        'en_name',
        'ar_name',
        'it_name',
        'ru_name',
        'sort_order',
        'status',
        'home',
        'home_sort_order',
        'home_img',
        'symbol',
        'banner_img',
    ];

    public function detail()
    {
        return $this->hasOne(SectionDetail::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function brandFilter($brand_id)
    {
        return !is_null($this->brands()->where('brand_id', $brand_id)->first());
    }

    public function delete()
    {
        $this->detail()->delete();
        parent::delete();
    }
}
