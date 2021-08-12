<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{
    public function index(){
        // $user = User::where('userId',Auth::user()->userId)->first();
        $getCustomerAddress = "";
        $customer = Customer::where('fkuserId',Auth::user()->userId)->with('user')->first();
        $user = Auth::user();
        if(!empty($customer)){
        $getCustomerAddress = Address::where('fkcustomerId',$customer->customerId)->first();
        
    }
    return view('myAccount',compact('customer','getCustomerAddress', 'user'));
    }

    public function updateUserInfo(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'firstName' => 'required|max:50',
            'lastName' => 'required',
            'email' => 'required',
        
        ]);


        $user = User::where('userId',$request->userId)->first();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->save();

        $customer = Customer::where('fkuserId',$user->userId)->first();
        // dd($customer);
        $customer->phone = $request->phone;
        $customer->save();

        Session::flash('success','User info updated succesfully');
        return back();
        
    }

    public function updateAddressInfo(Request $request){
        // dd($request->all());
        $user = User::where('userId',$request->userId)->first();
        $customer = Customer::where('fkuserId',$user->userId)->first();

        $address = Address::updateOrCreate([
            'fkcustomerId'   => $customer->customerId,
        ],[
            'shippingAddress'     => $request->shippingAddress,
            'billingAddress' => $request->billingAddress,
        ]);

        // $address = Address::where('fkcustomerId',$customer->customerId)->first();
        // $address->shippingAddress = $request->shippingAddress;
        // $address->billingAddress = $request->billingAddress;

        // $address->save();

        Session::flash('success','User address updated succesfully');
        return back();

    }

    public function updatePassword(Request $request){
        $this->validate($request, [
            'oldPassword' => ['required'],
            'newPassword' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        
        // User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        $user = User::where('email',$request->email)->first();

        $customer = Customer::where('fkuserId',$user->userId)->first();
            // dd(Hash::check($request->oldPassword, '$user->password'));
            if (Hash::check($request->oldPassword , $user->password )) {
               
                    $user->password = bcrypt($request->newPassword);
                    $user->save();
                    // admin::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
       
                    Session::flash('success','password updated successfully');
                    return redirect()->back();
                  }
                  
       
                  else{
                        Session::flash('success','old password does not match!');
                        return redirect()->back();
                      }
       
                 
            //      else{
            //         Session::flash('success','old password doesnt matched ');
            //         return redirect()->back();
            //   }
        

        // Session::flash('success','User Password updated succesfully');
        // return back();

        
    
          
    }
    
}
