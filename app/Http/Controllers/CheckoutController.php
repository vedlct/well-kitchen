<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipmentZone;
use App\Models\User;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Charges;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
class CheckoutController extends Controller
{
    public function index(){
        $shipmentZone = ShipmentZone::all();
        if (Auth::check()) {
            $customer = Customer::where('fkuserId', Auth::user()->userId)->with('address', 'order', 'user')->first();
            // dd($customer);
            return view('checkout', compact('customer', 'shipmentZone'));
        }
     return view('checkout', compact('shipmentZone'));

    // if (Auth::check()) {
    //     return 'user is loggin';
    // }else{
    //     return 'user not loogin';
    // }
}

        public function autocomplete(Request $request)
        {
            $search = $request->get('term');
            $result = Customer::where('phone', 'LIKE', '%'. $search. '%')->get();
            return response()->json($result);
        }


    public function searchUserByPhone(Request $request){
        // dd($request->phone);
        $phone = $request->phone;
        $customer = Customer::where('phone', $phone)->with('user','address')->get();
        // dd($customer);
        if($customer != null) {
            $user = $customer->first();
            return response()->json(['user' => $user, 'customer' => $customer]);
        }

        return response()->json(['customer'=> $customer],200);
    }

    public function shippingZone(Request $request){
        $deliveryFee = Charges::where('fkshipment_zoneId', $request->shipping_zone)->pluck('deliveryFee')->first();
        $orderTotal = number_format(\Cart::getSubTotal() + $deliveryFee);

        return response()->json(['deliveryFee' => $deliveryFee, 'orderTotal' => $orderTotal]);
    }
    

    public function checkoutSubmit(Request $request){
        // dd($request->all());
        // $phone = $request->phone;
        // $customer = Customer::where('phone', $phone)->first();
        // dd($customer);
        
        if ($request->fkcustomerId) {
            $fullAddress = $request->billingAddress;

            $address = new Address();
            $address->billingAddress = $fullAddress;
            $address->shippingAddress = $fullAddress;
            $address->fkcustomerId  = $request->fkcustomerId;
            $address->fkshipment_zoneId  = $request->fkshipment_zoneId;
            $address->save();
        } else {
            // dd($request->all());
            $guestUser =  new User();
            $guestUser->firstName = $request->first_name;
            $guestUser->lastName = $request->last_name;
            $guestUser->email = $request->email;
            $guestUser->password = Hash::make('123456');
            $guestUser->fkuserTypeId = 2;
            $guestUser->save();

            $customer = new Customer();
            $customer->fkuserId = $guestUser->userId;
            $customer->phone = $request->phone;
            $customer->status = 'active';
            $customer->save();

            $address = new Address();
            $address->billingAddress = $request->billingAddress;
            $address->shippingAddress = $request->billingAddress;
            $address->fkcustomerId  = $customer->customerId;
            $address->fkshipment_zoneId  = $request->fkshipment_zoneId;
            $address->save();

            Session::flash('success', 'User Registered Successfully');
            // return redirect('login');
        }

        $deliveryFee = 0;
        $deliveryFee += Charges::where('fkshipment_zoneId', $request->zone)->pluck('deliveryFee')->first();
    
        return back();
        
    }
}
