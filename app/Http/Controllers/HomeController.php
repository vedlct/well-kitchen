<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index(){

        $categories = Category::where('homeShow', 1)->take(4)->get();

        $products = Product::with('category','sku')->where('status', 'active')->get();

        $sku = Sku::with('product')->where('status', 'active')->get();

        $newArrival =  Product::with('sku')->where('status', 'active')->where('newarrived', 1)->get();

        $recommendedProduct = Product::with('sku')->where('status', 'active')->where('isrecommended', 1)->get();

        $testimonials = Testimonial::where('status', 'active')->where('home',1)->get();
        // dd($recommendedProduct);

        return view('welcome',compact('categories','products','sku','newArrival','recommendedProduct','testimonials'));

    }

    public function productDetails($id){
        $productDetails = Product::with('sku','details','images')->findOrfail($id);  
        
        return view('productDetails',compact('productDetails'));
    }
}
