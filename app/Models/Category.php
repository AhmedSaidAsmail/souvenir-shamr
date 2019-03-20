<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'section_id',
        'parent_id',
        'en_name',
        'it_name',
        'ru_name',
        'sort_order',
        'status',
        'home',
        'home_sort_order',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function detail()
    {
        return $this->hasOne(CategoryDetail::class);
    }

    public function links()
    {
        return $this->hasOne(CategoryLink::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
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
}
