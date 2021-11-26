<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use Newsletter;

class SubscriptionController extends Controller
{
    // public function subscribe(Request $request){
    //     $this->validate($request, [
    //         'email' => 'required|email'
    //      ]);

    //     // dd($request->all());
    //     if(isset($request->email)){

    //         $to_email = $request->email;
            
        
    //             // $to_email = Auth::user()->email;
    //             $data = array('name'=>'Flora Bangla', 'body' => 'save for email');
    //             // dd($data);
    //             Mail::send('emails.mail', $data, function($message) use ($to_email) {
    //             $message->to($to_email)
    //             ->subject('subscribe');
    //             $message->from('support@florabangla.com','Subscribtion Mail');
    //             });
    //             Session::flash('success', "Subscription added Successfully");
    //             return back();
            

    //     }
    // }

    public function subscribe(Request $request){
      
        // dd($request->all()); 
         $this->validate($request, [
            'email' => 'required|email'
         ]);

        if (Newsletter::isSubscribed($request->email)) {
            return redirect()->route('home')->with('error', 'This email already subscribed');
        }

        Newsletter::subscribe($request->email);

        $to_email = $request->email;
        $data = [];

        \Mail::send('emails.mail', $data, function ($message) use ($to_email) {
            $message->to($to_email)
                ->subject('Subscription Completion')
                // >setBody('<h4>You have successfully subscribed</h4>', 'text/html')
                ->setBody('<h4>You have successfully subscribed!</h4>', 'text/html');
        });

        return redirect()->route('home')->with('success', 'email subscribed successfully');


    }


}
