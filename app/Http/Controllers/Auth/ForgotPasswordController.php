<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Str;
use DB;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
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

    // public function sendResetLinkEmail(Request $request) {
           
             
    //         $request->validate([
    //             'email' => 'required|email|exists:user',
    //         ]);

    //         $token = Str::random(60);

    //         DB::table('password_resets')->insert([
    //             'email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()
    //         ]);

    //         Mail::send('auth.passwords.reset',['token' => $token], function($message) use ($request){
    //             $message->from($request->email);
    //             $message->to('saikotchondrobd@gmail.com');
    //             $message->subject('Reset password Notification');
    //         });

    //         return back()->with(['success' => 'we have emailed your password reset link']);


    //         // $status = Password::sendResetLink(
    //         //     $request->only('email')
    //         // );

    //         // if($status == Password::RESET_LINK_SENT){
    //         //     return [
    //         //         'status' => __($status)
    //         //     ];
    //         // }

    //         // throw ValidationException::withMessages([
    //         //     'email' => [trans($status)],
    //         // ]);

    //         // return back()->with(['success' => 'we have emailed your password reset link']);

    //     }
}
