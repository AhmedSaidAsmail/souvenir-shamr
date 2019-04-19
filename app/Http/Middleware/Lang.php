<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Lang
{
    /**
     * @const array languages Available Languages
     */
    const languages = ['en', 'ar', 'ru', 'it'];
    /**
     * @const string default_lang Default language
     */
    const default_lang = "en";

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = $request->route()->parameter('lang');
        $this->lang($request, $lang);
        return $next($request);
    }

    /**
     * Determine if session has lang and change or put lang if not exists
     *
     * @param Request $request
     * @param null $lang
     */
    private function lang(Request $request, $lang = null)
    {
        $session_lang = $this->sessionLang($request);
        if ($this->langIsTrueLang($lang) && $lang !== $session_lang) {
            $request->session()->put('lang', $lang);
        } elseif (!$session_lang) {
            $request->session()->put('lang', self::default_lang);
        }
    }

    /**
     * Check if lang is true language
     *
     * @param null $lang
     * @return bool
     */
    private function langIsTrueLang($lang = null)
    {
        return !is_null($lang) && in_array($lang, self::languages);
    }

    /**
     * Check if session has language or not
     *
     * @param Request $request
     * @return bool
     */
    private function sessionHasLang(Request $request)
    {
        return $request->session()->has('lang');
    }

    /**
     * Returning session language if it already set or returning null if not
     *
     * @param Request $request
     * @return string|null
     */
    private function sessionLang(Request $request)
    {
        return $this->sessionHasLang($request) ? $request->session()->get('lang') : null;
    }
}
