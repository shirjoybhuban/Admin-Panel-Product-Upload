<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Model\PasswordResetCode;
use App\Model\VerificationCode;
use App\Providers\RouteServiceProvider;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    protected $redirectTo;

    protected function redirectTo() {
        if (Auth::check() && Auth::user()->user_type == 'customer') {
            //dd('okk');
            //Toastr::success('Successfully Logged In',"Success");
            return $this->redirectTo = route('user.dashboard');
        }
        elseif (Auth::check() && Auth::user()->user_type == 'publisher') {
            Toastr::success('Successfully Logged In',"Success");
            return $this->redirectTo = route('seller.dashboard');
        }
        else {
            //return('/login');
            return('/');
        }
    }



//    protected function credentials(Request $request)
//    {
//        if(is_numeric($request->get('email'))){
//            return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
//        }
//        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
//            return ['email' => $request->get('email'), 'password'=>$request->get('password')];
//        }
//        return ['username' => $request->get('email'), 'password'=>$request->get('password')];
//    }

    protected function credentials(Request $request)
    {
        return ['phone' => $request->get('phone'), 'password'=>$request->get('password'),'banned'=>0];
    }

    public function username()
    {
        return 'phone';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
