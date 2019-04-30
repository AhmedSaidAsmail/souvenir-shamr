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
        return $this->lang($request, $next);
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function lang(Request $request, Closure $next)
    {
        if ($this->sessionHasTrueLang($request)) {
            return $this->redirectAccordingToSession($request, $next);
        } else {
            $request->session()->put('lang', self::default_lang);
            return $next($request);
        }

    }

    /**
     * Determine session has lang key and this lang key from lang list
     *
     * @param Request $request
     * @return bool
     */
    private function sessionHasTrueLang(Request $request)
    {
        return $request->session()->has('lang') && in_array($request->session()->get('lang'), self::languages);
    }

    /**
     * Handle request redirect according to session lang key
     *
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    private function redirectAccordingToSession(Request $request, Closure $next)
    {
        if ($request->session()->get('lang') == $request->route()->parameter('lang')) {
            return $next($request);
        } else {
            return $this->changeRouteAccordingToSession($request);
        }
    }

    /**
     * Redirect to the same route with lang changing
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function changeRouteAccordingToSession(Request $request)
    {
        $route_name = $request->route()->getName();
        $route_parameters = $request->route()->parameters();
        $session_lang = $request->session()->get('lang');
        return redirect()->route($route_name, array_replace($route_parameters, ['lang' => $session_lang]));
    }


}
