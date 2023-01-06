<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authenticated(){
        if(Auth::user()->role_as == '0'){ // 0 = target user
            return redirect('target_actor/dashboard')->with('message', 'Welcome to Admin Dashboard');
        }
        elseif(Auth::user()->role_as == '1')//1 = admin
        {
            return redirect('admin/dashboard')->with('message', 'You have logged in successfully!');
        }
        elseif(Auth::user()->role_as == '2')//2 = key actor
        {
            return redirect('key_actor/dashboard')->with('message', 'You have logged in successfully!');
        }
        else{
            return redirect('/');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
