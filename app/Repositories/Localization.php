<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class Localization
{
    const default_lang = "en";
    protected $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Determine what language is used
     *
     * @return string
     */
    protected function currentLanguage()
    {
        if ($this->request->session()->has('lang')) {
            return $this->request->session()->get('lang');
        }
        return self::default_lang;
    }
}