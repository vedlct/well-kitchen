<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class CuponController extends Controller
{
    public function couponSubmit(Request $data){
        $this->validate($data, [
            'couponCode' => 'required'
        ]);
        $couponCode = preg_replace('/\s/', '', $data->couponCode);
        // dd($couponCode);
        $promotion = Promotion::with('promoProduct')->where('promotionCode',$couponCode)->first();
        dd($promotion);
        if(!empty($promotion)){
            if ((date('Y-m-d h:i:s') >= $promotion->startDate) && (date('Y-m-d h:i:s') <= $promotion->endDate)){
                if($promotion->status == 'Active'){
                    // limit
                  $customerID = Customer::where('fkuserId',Auth::user()->userId)->first()->customerId;
                    $usedBefore = Order::where('fkcustomerId',$customerID)->where('discount',$couponCode)->count();
                }elseif($promotion->status == 'Inactive'){
                    session()->flash('message','This coupon is not active now.');
                    session()->flash('alert-class','alert-danger');
                }
            }else{
                session()->flash('message','This coupon has been expired.');
                session()->flash('alert-class','alert-danger');
            }
        }else{
            session()->flash('message','Invalid coupon code.');
            session()->flash('alert-class','alert-danger');
        }
    }
}
