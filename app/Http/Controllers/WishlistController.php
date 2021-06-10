<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $wishList=Wishlist::where('fkcustomerId',Auth::user()->userId)->with('sku', 'sku.product')->get();
            return view('wishlist',compact('wishList'));
        }else{
            return redirect('login');
        }

    }

   public function AddToWishlist($id)
   {
       if (auth()->check()) {
           $sku = Sku::where('skuId', $id)->first();
           $wishList=new Wishlist();
           $wishList->fkproductId=$id;
           $wishList->fkcustomerId=Auth::user()->userId;
           $wishList->save();
           Session::flash('success','Item added to wishlist');
           return back();

       } else {
           Session::flash('error','You need to be logged in to add itrm to wishlist');
           return back();
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
