<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryProducts($categoryId=null){

        if(empty($categoryId)){

            $products = Product::with('sku', 'images')->get();
        }

        if(!empty($categoryId)){
        $products = Product::with('sku', 'images')->where('categoryId', $categoryId)->get();
        dd($products);
        }

        return view('shop', compact('products'));
    }
}
