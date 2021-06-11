<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipmentZone;
use App\Models\Customer;
use Auth;

class CheckoutController extends Controller
{
    public function index(){
        $shipmentZone = ShipmentZone::all();
        if (Auth::check()) {
            $customer = Customer::where('fkuserId', Auth::user()->userId)->with('address', 'order', 'user')->first();

            return view('checkout', compact('customer', 'shipmentZone'));
        }
        return view('checkout', compact('shipmentZone'));
    }

    public function searchUserByPhone(Request $request){
        $phone = $request->phone;
        $getCustomer = Customer::query()
        ->where('phone', 'LIKE', "%{$phone}%")
        ->orWhere('optional_phone', 'LIKE', "%{$phone}%")
        ->with('user')
        ->get();
        // dd($getCustomer);
        return response()->json(['customer'=> $getCustomer],200);
    }

    public function checkoutSubmit(Request $request){
        dd($request->all());
        // $this->validate($request, [
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'address' => 'required',
        //     'phone' => 'required',
        //     'email' => 'required',
        //     'city' => 'required',
        //     'message' => 'required',
        //     // 'password' =>
        // ]);
        // // if (isset($request->register)) {
        // //     $user = new User();
        // //     $user->password = Hash::make($request->password);
        // //     $customer = new Customer();
        // // } else {
        // //     $user = Auth::user();
        // //     $customer = Customer::where('fkuserId', Auth::user()->userId)->with('address', 'order', 'user')->first();
        // // }

        
        // $user->firstName = $request->fname;
        // $user->lastName = $request->lname;
        // $user->address = $request->address;
        // $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->city = $request->city;
        // $user->message = $request->message;
        // $user->save();

        // $customer->phone = $request->phone;
        // $customer->fkuserId = $user->userId;
        // $customer->save();

        // $address = Address::where('fkcustomerId', $customer->customerId)->first();
        // if (empty($address)) {
        //     $address = new Address();
        // }

        // $address->billingAddress = $request->billing_address;
        // $address->fkshipment_zoneId = $request->area;
        // $address->fkcustomerId = $customer->customerId;
        // if (isset($request->billing_address2)) {
        //     $address->billingAddress = $request->billing_address2;
        // }
        // $address->save();
        // $orderId = $this->OrderInsert($customer->customerId);
        // if (!empty($customer->phone)) {
        //     $this->SendSms($customer->phone, $orderId);
        // }
        // Auth::login($user);
        // Session::flash('success', 'Order placed succesfully');

        // return back();
        
    }
}
