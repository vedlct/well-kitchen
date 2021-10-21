<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Rating;
use Session;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function ReviewSubmit(Request $request){
        // dd(Auth::user()->firstName);
        // dd($request->all());
        // $this->validate($request, [
        //     'review' => 'required',
        // ]);

        // $user = Auth::user()->userId;
        $customer = Customer::where('customerId',$request->customerId)->pluck('customerId')->first();
        // dd($customer);
        $product = Product::where('productId',$request->productId)->pluck('productId')->first();
        // dd($product);
        $reviewIsExist = Review::where('customerID',$customer)->where('fkproductId',$product)->first();
        $ratingIsExist = Rating::where('fkcustomerId',$customer)->where('fkproductId',$product)->first();
        // dd($reviewIsExist);
        if(!empty($reviewIsExist)) {
            // dd('review has with this customer and pro info');
            // dd( $request->review);
             $ratingIsExist->value = $request->rating;
             $ratingIsExist->save();

                $review=new Review();
                $review->fkproductId = $reviewIsExist->fkproductId;
                $review->customerID = $ratingIsExist->fkcustomerId;
                $review->review = $request->review;
                $review->rating = $ratingIsExist->ratingId;
                $review->save();
                Session::flash('success','Review update succesfully');
                return back();
        }else{
            // dd('add review');
              $rating = new Rating();
        $rating->value = $request->rating;
        $rating->fkproductId=$request->productId;
        $rating->fkcustomerId=$request->customerId;
        $rating->save();

        $review=new Review();
        $review->fkproductId=$rating->fkproductId;
        $review->customerID=$rating->fkcustomerId;
        $review->review=$request->review;
        $review->rating= $rating->ratingId;
        $review->save();
        }
       

      Session::flash('success','Review added succesfully');
        return back();

    }
}
