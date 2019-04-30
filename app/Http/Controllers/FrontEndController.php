<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
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
     * Redirecting to welcome page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        return redirect()->route('home.welcome', ['lang' => $this->redirectedLang($request)]);
    }

    /**
     * Determine if session has true lang key
     *
     * @param Request $request
     * @return bool
     */
    private function sessionHasTrueLang(Request $request)
    {
        return $request->session()->has('lang') && in_array($request->session()->get('lang'), self::languages);
    }

    /**
     * Providing the redirect lang key
     *
     * @param Request $request
     * @return string
     */
    private function redirectedLang(Request $request)
    {
        return $this->sessionHasTrueLang($request) ? $request->session()->get('lang') : self::default_lang;
    }

    public function homeWelcome($lang)
    {
        return view('front.welcome', compact('lang'));
    }

    public function changeLang(Request $request, $lang)
    {
        if (in_array($lang, self::languages)) {
            $request->session()->put('lang', $lang);
            return back();
        }

    }

}
