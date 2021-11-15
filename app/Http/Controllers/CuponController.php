<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Cart;
use Session;


class CuponController extends Controller
{

    public function promoSubmit(Request $request){
        $this->validate($request, [
           'promo_code' => 'required'
        ]);

        $promo_code = preg_replace('/\s/', '', $request->promo_code);

        $promo= Promo::where('promo_code', $promo_code)->where('status', 'active')->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->where('discount', '>', 0)->first();
        if(!empty($promo)) {
            $discountAmount = (\Cart::getSubTotal() * $promo->discount) / 100;

            $newTotal = \Cart::getSubTotal() - $discountAmount;
            Session::put('sub', $newTotal);
            Session::put('promoCode', $promo->discount);
            Session::put('discountAmount', $discountAmount);
            $msg_success = 'Promo code applied successful.';
        return response()->json(['msg_success' => $msg_success]);

        }

        if(empty($promo)){
            $msg_error = 'Given promo code expired.';
        return response()->json(['msg_error' => $msg_error]);

        }
    }



    public function couponSubmit(Request $data){
        $this->validate($data, [
            'couponCode' => 'required'
        ]);
        $couponCode = preg_replace('/\s/', '', $data->couponCode);
        $promotion = Promotion::with('promoProduct')->where('promotionCode',$couponCode)->first();
        if(!empty($promotion)){
            if ((date('Y-m-d h:i:s') >= $promotion->startDate) && (date('Y-m-d h:i:s') <= $promotion->endDate)){

                if($promotion->status == 'active'){

                    if(Auth::check()){
                        $customerID = Customer::where('fkuserId',Auth::user()->userId)->first()->customerId;
                    }else{
                        return redirect()->route('login');
                    }
                    // limit

                    $usedBefore = Order::where('fkcustomerId',$customerID)->where('discount',$couponCode)->count();
                    // dd($usedBefore);
                    if ($promotion->useLimit > $usedBefore){
                        $cartProduct = \Cart::getContent();
                        $common = array_intersect($promoProduct = $promotion->promoProduct->pluck('fkproductId')->toArray(), $cartProduct->pluck('associatedModel.productId')->toArray());
                        if(count($common)>0){
                            $previousCoupon = $cartProduct->pluck('attributes.couponCode')->toArray();
                            if (!count(array_filter($previousCoupon))>0){
                                foreach ($promoProduct as $promoProductId){
                                    foreach ($cartProduct as $cartProductData){
                                        if($cartProductData['associatedModel']['productId'] == $promoProductId){
                                            if(!is_null($promotion->percentage)){
                                                $discount = $cartProductData['price'] * ($promotion->percentage/100);
                                            }elseif (is_null($promotion->percentage)){
                                                if($cartProductData['price'] < $promotion->amount){
                                                    Session::flash('warning', 'This coupon amount is bigger than product price.');
                                                    break;
                                                }else{
                                                    $discount = $promotion->amount;
                                                }
                                            }
                                            $newprice = $cartProductData['price'] - $discount;
                                            data_set($cartProductData->attributes, 'oldPrice', $cartProductData->price);
                                            data_set($cartProductData->attributes, 'discount', $discount);
                                            data_set($cartProductData->attributes, 'couponCode', $couponCode);
                                            \Cart::update($cartProductData->id,[
                                                'price' => $newprice
                                            ]);
                                        }
                                    }
                                }
                                Session::flash('success', 'Coupon applied successful.');
                            }else{
                                Session::flash('warning', 'You can not use more than one coupon at a time.');
                            }
                        }else{
                            Session::flash('warning', 'This coupon is not applicable for your shopping cart');
                        }

                    }else{
                            Session::flash('warning', 'You have reached the this coupon usage limit');
                        }
                }elseif($promotion->status == 'Inactive'){
                    Session::flash('warning', 'This coupon is not active now');
                }
            }else{
                Session::flash('warning', 'This coupon has been expired.');
            }
        }else{
            Session::flash('warning', 'Invalid coupon code.');
        }
        // return 'ok';
        return back();
    }
}
