<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\Customer;
use App\Models\UserType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function customerSearch(Request $data){
        return Customer::where('phone', 'like', "%{$data->phoneNumber}%")->get();
    }

    public function customerData(Request $r){
        $customerData=Customer::with('user','address','membership')->find($r->customerName);
        $point=$customerData->totalPoint($customerData->customerId);
        $customerData->point=$point;
        return response()->json($customerData);
    }

    public function customerStore(Request $data){
        $this->validate($data, [
           'firstName' => 'required',
           'lastName' => 'required',
           'phone' => 'required|numeric',
        ]);

        $user = new User();
        $user->firstName = $data->firstName;
        $user->lastName = $data->lastName ?? null;
        $user->email = $data->email ?? null;
        $user->password = null;
        $user->fkuserTypeId = '2';
        $user->save();

        $customer = new Customer();
        $customer->fkuserId =$user->userId;
        $customer->phone = $data->phone;
        $customer->optional_phone = $data->optionalPhone;
        $customer->status = 'active';
        $customer->save();

        $customerId = $customer->customerId;

        $address = new Address();
        $address->fkcustomerId = $customerId;
        $address->billingAddress = $data->billingAddress;
        $address->shippingAddress = $data->shippingAddress ?? null;
        $address->fkshipment_zoneId = $data->deliveryLocation ?? null;
        $address->save();

        $customerData=Customer::with('user','address')->find($customerId);
        return $customerData;
    }

    public function index(){
        $roles=UserType::all();
        return view('user.index',compact('roles'));
    }

    public function userList(Request $r){
        $user=User::with('userType');
        return Datatables::of($user)->make(true);
    }

    public function customer(){
//        $customers=customer::all();
        return view('user.customer');
    }

    public function customerList(Request $r){
        $customers=Customer::with('user')->get();
        return Datatables::of($customers)->make(true);
    }


    public function changeRole(Request $request){
        $this->validate($request,[
            'role' => 'required'
        ]);
        $user = User::find($request->userId);
        $user->fkuserTypeId = $request->role;
        $user->save();
    }

    public function membershipStatus(Request $request){
        $customer = Customer::where('fkuserId', $request->userId)->first();
        if($customer->membership == 'yes'){
            $customer->membership = 'no';
        }
        elseif ($customer->membership == 'no'){
            $customer->membership = 'yes';
        }
        $customer->save();

        return response()->json(['userId' => $customer->fkuserId, 'membership' => $customer->membership]);
    }

}
