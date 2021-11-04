<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request){
        $this->validate($request, [
            'email' => 'required|email'
         ]);

        // dd($request->all());
        if(isset($request->email)){

            $to_email = $request->email;
            
        
                // $to_email = Auth::user()->email;
                $data = array('name'=>'Flora Bangla', 'body' => 'save for email');
                // dd($data);
                Mail::send('emails.mail', $data, function($message) use ($to_email) {
                $message->to($to_email)
                ->subject('subscribe');
                $message->from('support@florabangla.com','Subscribtion Mail');
                });
                Session::flash('success', "Subscription added Successfully");
                return back();
            

        }
    }
}
