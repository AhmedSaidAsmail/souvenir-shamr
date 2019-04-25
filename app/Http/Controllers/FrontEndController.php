<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    /**
     * Redirecting to welcome page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        return redirect()->route('home.welcome', ['lang' => $request->session()->get('lang')]);
    }

    public function homeWelcome($lang)
    {
        return view('front.welcome', compact('lang'));
    }

}
