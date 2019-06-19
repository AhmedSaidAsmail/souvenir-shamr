<?php

namespace App\Http\Controllers\AuthCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        $this->setPrevUrl($request);
        return view('front.customer.login');
    }

    /**
     * @param Request $request
     * @return void
     */
    private function setPrevUrl(Request $request)
    {
        if (!$request->session()->has('prev_url') || is_null($request->session()->get('prev_url'))) {
            $request->session()->put('prev_url', url()->previous());
        }
    }

    private function getPrevUrl(Request $request)
    {
        if ($request->session()->has('prev_url') && !is_null($request->session()->get('prev_url'))) {
            return $request->session()->get('prev_url');
        }
        return route('home');
    }

    private function destroyPrevUrl(Request $request)
    {
        $request->session()->put('prev_url', null);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $attemptArray = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        if (Auth::guard('customer')->attempt($attemptArray, $request->get('remember'))) {
            $prev = $this->getPrevUrl($request);
            $this->destroyPrevUrl($request);
            return redirect()->to($prev);
            //return redirect()->route('home');
        }
        return redirect()
            ->back()
            ->with('failure',
                sprintf('The email or password you entered isn\'t correct. If you\'ve forgotten your password, please reset it. <a href="%s">Click here</a>',
                    route('customer.password.reset')));
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->back();
    }
}
