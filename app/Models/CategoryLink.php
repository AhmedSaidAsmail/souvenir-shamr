<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryLink extends Model
{
    protected $fillable = [
        'category_id',
        'header_1',
        'header_2',
        'link',
    ];
}
