<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class LocalizationModelRepo extends Localization
{
    public function translate(Model $model, $field)
    {
        return $model->{$this->currentLanguage() . "_" . $field};
    }
}