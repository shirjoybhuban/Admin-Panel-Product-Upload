<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function ShowLoginForm()
    {
        return view('auth.admin.login');
    }

    public function LoginCheck(Request $request)
    {
       $user = User::where('email', $request->email)->first();
       if (!empty($user) && $user->user_type == 'admin') {
           $credential = [
               'email' => $request->email,
               'password' => $request->password,
               'user_type' => 'admin',
           ];
           if (Auth::attempt($credential)) {
               Toastr::success('Successfully Logged In!');
               return redirect()->route('admin.products.index');
           }else {
               //dd('sdfsadf');
               Toastr::Error('Invalid Credential','Error');
               return redirect()->route('admin.login');
           }

           Toastr::Error('Invalid Credential','Error');
           return redirect()->route('admin.login');
       }


    }
}
