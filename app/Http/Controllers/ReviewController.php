<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Session;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function ReviewSubmit(Request $request){
        // dd(Auth::user()->firstName);
        // dd($request->all());
        $this->validate($request, [
            'review' => 'required',
        ]);

        $review=new Review();
        $review->fkproductId=$request->productId;
        $review->customerID=$request->customerId;
        $review->review=$request->review;
        $review->rating= $request->rating;
        $review->save();

        Session::flash('success','Review added succesfully');
        return back();

    }
}
