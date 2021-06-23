<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\Seller;
use App\Model\Shop;
use App\Model\VerificationCode;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;
    public function login(Request $request)
    {
        //dd($request->all());
        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password,
            'banned' => 0,
        ];
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('mudihat')-> accessToken;
            $success['user'] = $user;
            if ($user->user_type == 'seller'){
                $seller = Seller::where('user_id',$user->id)->first();
                $shop = Shop::where('user_id',$user->id)->first();
                $success['seller_id'] = $seller->id;
                $success['shop_name'] = $shop->name;
                $success['verification_status'] = $seller->verification_status;
            }
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Unauthorised'], 401);
        }
    }
    public function register(Request $request)
    {
        $userEmailCheck = User::where('email',$request->email)->first();
        $userPhoneCheck = User::where('phone',$request->phone)->first();

        if (!empty($userEmailCheck)){
            return response()->json(['success'=>true,'response' =>"This email already exist!"], 405);
        }
        if (!empty($userPhoneCheck)){
            return response()->json(['success'=>true,'response' =>"This number already exist!"], 405);
        }
        $refferalValue = BusinessSetting::where('type','refferal_value')->first();
        $userReg = new User();
        $userReg->name = $request->name;
        $userReg->email = $request->email;
        $userReg->phone = $request->phone;
        $userReg->password = Hash::make($request->password);
        $userReg->user_type = 'customer';
        $userReg->referral_code = mt_rand(000000,999999);
        $userReg->referred_by = $request->referral_code;
        if ($userReg->referred_by !=null) {
            $userReg->balance = $refferalValue->value;
            $refferal_by_user = User::where('referral_code', $request->referral_code)->first();
            $refferal_by_user->balance += $refferalValue->value;
            $refferal_by_user->save();
        }
        $userReg->banned = 1;
        $userReg->save();

        $verification = VerificationCode::where('phone',$userReg->phone)->first();
        if (!empty($verification)){
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $userReg->phone;
        $verCode->code = mt_rand(1111,9999);
        $verCode->status = 0;
        $verCode->save();

        $text = "Dear ".$userReg->name.", Your MudiHat OTP is: ".$verCode->code;
        UserInfo::smsAPI("88".$verCode->phone,$text);
        if (!empty($userReg))
        {
            return response()->json(['success'=>true,'response'=> 'Registration Successful. Please enter OTP code. '], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
//        return response()->json(['success'=>true,'response' =>$success], $this-> successStatus);
    }


}
