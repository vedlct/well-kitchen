<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;

class LoginController extends Controller
{
    public function NormalLogin(Request $request){
        $this->validate($request,[
            'phone'=>'required|numeric|digits:11',
            'password'=>'required'
        ]);

        $user=User::where('phone',$request->phone)->first();
        if(!empty($user)){
            if(Hash::check($request->password,$user->password)) {
                if ($user->status==1) {
                    Auth::login($user);
                    if(Session::has('back')){
                        return redirect(Session::get('back'));
                    }
                    else{
                        return redirect()->route('User.profile');
                    }
                }
                else {
                    return redirect()->back()->withErrors(
                        [
                            'verify' => 'Please verify your phone'
                        ]
                    );
                }
            }
            else{
                Session::flash('error','Invalid password');
                return redirect()->back()->withErrors(
                    [
                        'password' => 'Invalid password'
                    ]
                );
            }
        }
        else{
            Session::flash('error','Phone number is not registered');
            return redirect()->back()->withErrors(
                [
                    'phone' => 'Phone number is not registered'
                ]
            );
        }

    }

    public function OtpLogin(Request $request)
    {
        $this->validate($request,[
            'phone'=>'required|numeric|digits:11',
        ]);

        $user=User::where('phone',$request->phone)->first();
        if(!empty($user)){
            Session::forget('phone');
            Session::put('phone',$user->phone);
            UserController::SendSms($user->phone);
            return redirect()->route('Register.otp.index');
        }
        else{
            return redirect()->back()->withErrors(
                [
                    'otp-phone' => 'Invalid phone number'
                ]
            );
        }
        $phone=Session::get('phone');
        return view('auth.otp-verify',compact('phone'));
    }

    public function ForgotPassword()
    {
        return view('auth.forgotPassword');
    }

    public function ForgotPasswordSubmit(Request $request)
    {
        $this->validate($request,[
            'phone'=>'required'
        ]);

        $user=User::where('phone',$request->phone)->first();
        if (!empty($user)) {
            Session::put('forgotPassword',$user);
            UserController::SendRecoverPasswordSms($request->phone);
            Session::put('phone',$user->phone);
            return redirect()->route('Register.otp.index');
        }
        else {
            return redirect()->back()->withErrors(
                [
                    'phone'=>'Your phone is not registered!'
                ]
            );
        }

    }

    public function NewPasswordForm()
    {
        return view('auth.newPassword');
    }

    public function NewPasswordSubmit(Request $request)
    {
        $this->validate($request,[
            'password'=>'required',
            'confirm_password'=>'same:password'
        ]);
        $user=User::findOrfail(Session::get('forgotPassword')->userId);
        $user->password=Hash::make($request->password);
        $user->save();
        Auth::login($user);
        Session::flash('success','Your password changed successfully');
        return redirect()->route('profile');
    }
}
