<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Session;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }
    public function submitContactInfo(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        Session::flash('success','Contact send succesfully');
        return back();


    }
}
