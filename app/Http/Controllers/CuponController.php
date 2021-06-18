<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Cart;


class CuponController extends Controller
{
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
                                                    session()->flash('message','This coupon amount is bigger than product price.');
                                                    session()->flash('alert-class','alert-warning');
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
                                session()->flash('message','Coupon applied successful.');
                                session()->flash('alert-class','alert-success');
                            }else{
                                session()->flash('message','You can not use more than one coupon at a time.');
                                session()->flash('alert-class','alert-danger');
                            }
                        }else{
                            session()->flash('message','This coupon is not applicable for your shopping cart.');
                            session()->flash('alert-class','alert-warning');
                        }

                    }else{
                            session()->flash('message','You have reached the this coupon usage limit.');
                            session()->flash('alert-class','alert-danger');
                        }
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
        // return 'ok';
        return back();
    }
}
