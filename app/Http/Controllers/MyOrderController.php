<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;

class MyOrderController extends Controller
{
    public function index(){
        if(Auth::check()){
            $customer = Customer::where('fkuserId',Auth::user()->userId)->with('user')->first();
        
            $orderedProducts = Order::where('fkcustomerId', $customer->customerId)->with('orderedProduct.sku.product','promo','transaction')->orderBy('created_at', 'desc')->paginate(10);
        //    dd($orderedProducts);
            return view('myOrder',compact('orderedProducts'));
        } else {
            return redirect()->route('login');
        }
       
    }

    public function orderdetails($orderId){
        // dd($orderId);
        $orderedItem = OrderProduct::where('fkorderId',$orderId)->with('sku.product','order.promo')->get();
        // dd($orderedItem);
        return view('myOrderDetails',compact('orderedItem'));
    }
}
