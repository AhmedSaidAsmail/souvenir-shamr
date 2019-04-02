<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = [
        'product_id', 'image', 'sort_order', 'filter_item_id'
    ];
    /**
     * @var string $path Image stored folder path
     */
    private $path = "/images/products/";
    /**
     * @var array $thumbs Image thumbs folders
     */
    private $thumbs = ['thumb'];

    public function filterItem()
    {
        return $this->belongsTo(FilterItem::class);
    }

    public function delete()
    {
        uploadingResolver()->remove($this->path, $this->image, $this->thumbs);
        parent::delete();
    }
}
