<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localization extends Model
{
    protected $fillable = [
        'word', 'word_en', 'word_it', 'word_ar', 'word_ru'
    ];
}
