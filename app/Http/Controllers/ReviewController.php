<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Session;
use Auth;

class ReviewController extends Controller
{
    public function ReviewSubmit(Request $request){
        $this->validate($request, [
            'review' => 'required',
        ]);

        $review=new Review();
        $review->fkproductId=$request->productId;
        $review->customerID=Auth::user()->userId;
        $review->review=$request->review;
        $review->rating= $request->rating;
        $review->save();

        Session::flash('success','Review added succesfully');
        return back();

    }
}
