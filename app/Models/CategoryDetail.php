<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    protected $fillable = [
        'category_id',
        'en_meta_title',
        'ar_meta_title',
        'it_meta_title',
        'ru_meta_title',
        'en_meta_keywords',
        'ar_meta_keywords',
        'it_meta_keywords',
        'ru_meta_keywords',
        'en_meta_description',
        'ar_meta_description',
        'it_meta_description',
        'ru_meta_description',
    ];
}
