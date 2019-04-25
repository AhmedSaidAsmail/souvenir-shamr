<?php

namespace App\Repositories;

use App\Models\Localization as LocalizationModel;

class LocalizationRepo extends Localization
{

    /**
     * Translate word if exists in localization table
     *
     * @param $word
     * @return string
     */
    public function findByWord($word)
    {
        $fixed_word = $this->replaceSpaces($word);
        $trans = LocalizationModel::where('word', $fixed_word)->first();
        if (!is_null($trans)) {
            return $trans->{'word_' . $this->currentLanguage()};
        }
        return $word;
    }

    private function replaceSpaces($word)
    {
        return str_replace(' ', '_', strtolower($word));
    }
}