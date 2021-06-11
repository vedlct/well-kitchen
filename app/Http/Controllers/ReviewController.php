<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Session;

class ReviewController extends Controller
{
    public function ReviewSubmit(Request $request){
        $review=new Review();
        $review->fkproductId=$request->productId;
        $review->review=$request->review;
        $review->rating= $request->rating;
        $review->save();

        Session::flash('success','Review added succesfully');
        return back();

    }
}
