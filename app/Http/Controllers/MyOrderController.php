<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Order;

class MyOrderController extends Controller
{
    public function index(){
        if(Auth::check()){
            $customer = Customer::where('fkuserId',Auth::user()->userId)->with('user')->first();
        
            $orderedProducts = Order::where('fkcustomerId', $customer->customerId)->with('orderedProduct.sku.product')->orderBy('created_at', 'desc')->paginate(10);
           
            return view('myOrder',compact('orderedProducts'));
        } else {
            return redirect()->route('login');
        }
       
    }
}
