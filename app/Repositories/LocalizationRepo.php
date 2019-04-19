<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Localization;

class LocalizationRepo
{
    const default_lang = "en";
    private $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Translate word if exists in localization table
     *
     * @param $word
     * @return string
     */
    public function findByWord($word)
    {
        $trans = Localization::where('word', $word)->first();
        if (!is_null($trans)) {
            return $trans->{'word_' . $this->currentLanguage()};
        }
        return $word;
    }

    /**
     * Determine what language is used
     *
     * @return string
     */
    private function currentLanguage()
    {
        if ($this->request->session()->has('lang')) {
            return $this->request->session()->get('lang');
        }
        return self::default_lang;
    }
}