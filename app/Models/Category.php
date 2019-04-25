<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'section_id',
        'parent_id',
        'en_name',
        'ar_name',
        'it_name',
        'ru_name',
        'sort_order',
        'status',
        'home',
        'home_sort_order',
        'image',
        'banner_image',
        'recommended',
        'welcome_image',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * @param array $children
     * @return Category[]
     */
    public function allChildren(&$children = [])
    {
        if ($this->children()->exists()) {
            $categories = $this->children()->get()->all();
            /**
             * @var Category $category
             */
            foreach ($categories as $category) {
                $children[] = $category;
                $category->allChildren($children);
            }
        }
        return $children;
    }

    public function allBrands(&$brands = [])
    {
        $brands = array_merge($brands, array_udiff($this->brands()->get()->all(), $brands, function ($brand_1, $brand_2) {
            $id_1 = $brand_1->id;
            $id_2 = $brand_2->id;
            if ($id_1 == $id_2) {
                return 0;
            }
            return $id_1 > $id_2 ? 1 : -1;
        }));
        if ($this->parent()->exists()) {
            $this->parent()->first()->allBrands($brands);
        }
        return $brands;
    }

    public function detail()
    {
        return $this->hasOne(CategoryDetail::class);
    }

    public function link()
    {
        return $this->hasOne(CategoryLink::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'filter_category');
    }

    public function syncLink(array $attributes = [])
    {
        if (!$this->link()->exists() && !empty($attributes)) {
            $this->link()->create($attributes);
        } else {
            $this->link()->update($attributes);
        }

    }

    public function fullName($property, $separating = " > ")
    {
        $fullName = [];
        $fullName[] = $this->{$property};
        if (!is_null($this->parent)) {
            $fullName[] = $this->parent->fullName($property);
        }
        return self::joinName($fullName, $separating);
    }

    private static function joinName(array $name, $separating)
    {
        return implode($separating, array_reverse($name));
    }

    public static function recommendationCategories()
    {
        return (new static)
            ->where('recommended', 1)
            ->where('image', '!=', '')
            ->orderBy('sort_order')
            ->limit(3)
            ->get()
            ->all();
    }

    public static function homeCategories()
    {
        return (new static)
            ->where('status', 1)
            ->where('home', 1)
            ->where('welcome_image', '!=', '')
            ->orderBy('home_sort_order')
            ->limit(2)
            ->get()
            ->all();
    }
}
