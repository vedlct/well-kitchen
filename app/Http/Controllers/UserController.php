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
use Illuminate\Support\Facades\Auth;

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

    public function registerInsert(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric|digits:11|unique:user,phone',
        ]);

        $user = new User();
        $user->firstName = $request->firstName;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $user->fkuserTypeId = '2';
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $customer = new Customer();
        $customer->fkuserId = $user->userId;
        $customer->phone = $user->phone;
        $customer->save();

        $this->SendSms($request->phone);
        Session::put('phone', $request->phone);

        return redirect()->route('Register.otp.index');
    }



    public function OtpIndex()
    {
        $phone = Session::get('phone');

        return view('auth.otp-verify', compact('phone'));
    }

    public static function SendSms($phone)
    {
        $userName = 'wellkitchen';
        $password = 'wellkitchen@123';
        $brand = '';
        $arrContextOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];
        $balance = file_get_contents('https://msms.techcloudltd.com/pages/RequestBalance.php?user_name='.urlencode($userName).'&pass_word='.urlencode($password), false, stream_context_create($arrContextOptions)); /* balance api*/
        $bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $en = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        $otp = mt_rand(1000, 9999);
        Session::forget('otp');
        Session::put('otp', $otp);
        $sms = 'প্রিয় গ্রাহক আপনার রেজিস্ট্রেশন ও টি পি: '.str_replace($en, $bn, $otp).' এটি পরবর্তী ৩ ঘন্টার জন্য কার্যকর থাকবে ! ';
        file_get_contents('https://msms.techcloudltd.com/pages/RequestSMS.php?user_name='.urlencode($userName).'&pass_word='.urlencode($password).'&brand='.urlencode($brand).'&type=1&masking=2&destination='.urlencode($phone).'&sms='.urlencode($sms), false, stream_context_create($arrContextOptions));
    }

    public function OtpResend(Request $request)
    {
        $this->SendSms($request->phone);

        return response()->json('Code send ', 200);
    }

    public function verifyOtp(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);
        $userOtp = implode($request->otp);
        $sentOtp = Session::get('otp');
        if ($userOtp == $sentOtp) {
            if (Session::has('forgotPassword')) {
                return redirect()->route('Login.newPassword');
            } else {
                $user = User::where('phone', Session::get('phone'))->first();
                $user->status = 1;
                $user->save();
                $customer = Customer::where('fkuserId', $user->userId)->first();

                if (empty($customer)) {
                    $customer = new Customer();
                    $customer->fkuserId = $user->userId;
                    $customer->phone = $user->phone;
                    $customer->save();


                }

                Auth::login($user);
                Session::flash('success', 'Your registration is completed');
                if (Session::has('back')) {
                    return redirect(Session::get('back'));
                } else {
                    return redirect()->route('profile');
                }
            }


        } else {
            Session::flash('error', 'Invalid OTP code');

            return back();
        }
    }

}
