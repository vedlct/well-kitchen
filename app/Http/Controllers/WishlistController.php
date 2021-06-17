<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {

        if(Auth::check()){
            $user = Auth::user()->userId;
            // dd($user);
            $customer = Customer::where('fkuserId', $user)->pluck('customerId')->first();

            $lists=Wishlist::where('fkcustomerId',$customer)->with('sku', 'sku.product')->get();
            // dd($lists);
            return view('wishlist',compact('lists'));
        }else{
            return redirect('login');
        }

    }

   public function AddToWishlist(Request $request)
   {
    //    dd($request->all());
       if (auth()->check()) {
           
            $sku = Sku::where('skuId',$request->_sku)->first();
            $user = Auth::user()->userId;
            $customer = Customer::where('fkuserId',$user)->pluck('customerId')->first();
            $wishLists = Wishlist::where('fkcustomerId',$customer)->where('fkproductId',$sku->fkproductId)->count();
              
            //   dd($wishLists<=0);
              if($wishLists<=0){

                    $wishList=new Wishlist();
                    $wishList->fkcustomerId = $customer;
                    $wishList->fkproductId = $sku->fkproductId;
                    $wishList->save();
                    return response()->json(['error'=>null]);
                    // Session::flash('success','Item added to wishlist');
                    // return back();
              }else{
                  return response()->json(['error'=>'itemHas']);
              }
           
              
              

        //    $sku = Sku::where('skuId', $id)->first();
        //    $wishList=new Wishlist();
        //    $wishList->fkproductId=$id;
        //    $wishList->fkcustomerId=Auth::user()->userId;
        //    $wishList->save();
        //    Session::flash('success','Item added to wishlist');
        //    return back();

       } else {
        return response()->json(['error'=>'login']);
        //    Session::flash('error','You need to be logged in to add item to wishlist');
        //    return back();
       }

   }

   public function RemoveItem($id)
   {
       $wishList=Wishlist::find($id);
       $wishList->delete();
       Session::flash('success','Item removed from wishlist');
        return back();
   }
}
