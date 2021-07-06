<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function getUserEmail(Request $request) {
            // dd($request->all());
            $user =  User::whereEmail($request->email)->first();
             if($user->count() < 0){
                return redirect()->back()->with(['error' => 'Email not exist']);
             }

            //  $user = Sentinel::findById($user->userId);
            //  $reminder = Reminder::exists($user) ? : Reminder::create($user);
            //  $this->sendEmail($user, $reminder->code);

             return redirect()->back()->with(['success' => 'Reset code sent to your email']);
    }
}
