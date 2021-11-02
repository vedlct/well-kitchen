<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\Customer;
use App\Models\UserType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Illuminate\Support\Facades\Hash;
use Image;
use Auth;

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

    public function create(){
        $roles = UserType::all();
        return view('user.create',compact('roles'));
    }

    public function store(Request $request){
        $this->validate($request, [
           'firstName' => 'required',
           'lastName' => 'required',
           'email' => 'required|email|unique:user,email',
           'phone' => 'required|numeric|unique:user,phone',
           'new_password' => 'required|string|min:8',
           'confirm_password' => 'required|string|min:8',
           'role' => 'required',
        ]);

        $user = new User();

        if ($request->new_password == $request->confirm_password) {
            $user->password = bcrypt($request->new_password);
            $user->save();
        }else{
            Session::flash('danger', 'Password did not match!');
            return redirect()->back();
        }

        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName ?? null;
        $user->email = $request->email ?? null;
        $user->phone = $request->phone ?? null;
        $user->fkuserTypeId = $request->role;
        $user->save();

        if($request->fkuserTypeId == 2){
            $customer = new Customer();
            $customer->fkuserId = $user->userId;
            $customer->phone = $request->phone;
            $customer->status = 'active';
            $customer->save();
        }

        Session::flash('success', 'User created successfully!');
        return redirect()->route('user.index');
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

    public function changeUserPassword(Request $request){
        $this->validate($request, [
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
        ]);

        $user = User::where('userId', $request->userId)->first();

        if ($request->new_password == $request->confirm_password) {
            $user->password = bcrypt($request->new_password);
            $user->save();
            echo 'success';
        }else{
            echo 'danger';
        }
    }

    public function adminProfileEdit($userId){
        $user = User::where('userId', $userId)->first();
        return view('profile.adminProfile', compact('user'));
    }

    public function adminProfileUpdate(Request $request, $userId){
        $user = User::where('userId', $userId)->first();

        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        
        if ($request->hasFile('profile_image')) {
            $originalExtension = $request->profile_image->getClientOriginalExtension();
            $uniqueImageName = $user->firstName.rand(100, 999).'.'.$originalExtension;
            $image = Image::make($request->profile_image);
            $image->save(public_path().'/userImage/'.$uniqueImageName);
            $user->profile_image = $uniqueImageName;
            $user->save();
        }

        if($request->current_password!=null){
            $this->validate($request, [
                'current_password' => 'required|string|min:8',
                'new_password' => 'required|string|min:8',
                'confirm_password' => 'required|string|min:8',
            ]);

            if ($request->current_password != $request->new_password) {
                if ($request->new_password == $request->confirm_password && Hash::check($request->current_password, Auth::user()->password)) {
                    $user->password = bcrypt($request->new_password);
                    $user->save();
    
                    Session::flash('success', 'Password updated successfully!');
                    return redirect()->back();
                }
    
                Session::flash('danger', 'Password did not match!');
                return redirect()->back();
            }
    
            Session::flash('danger', 'Please enter new password!');
            return redirect()->back();
        }

        Session::flash('success', 'Profile updated successfully!');
        return redirect()->back();
    
    }

}
