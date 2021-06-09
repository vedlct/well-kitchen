<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sku;
use App\Models\ProductImages;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categoryProducts($categoryId=null){

        if(empty($categoryId)){

            $products = Product::with('sku', 'images')->paginate(5);
        }

        if(!empty($categoryId)){
        $products = Product::with('sku', 'images')->where('categoryId', $categoryId)->paginate(5);
        // dd($products);
        }

        return view('shop', compact('products'));
    }

    public function searchByProducts(Request $request){
        $allSearch = $request->allSearch;
        $products = Product::query()
        ->where('productName', 'LIKE', "%{$allSearch}%")
        ->orWhere('productCode', 'LIKE', "%{$allSearch}%")
        ->orWhere('tag', 'LIKE', "%{$allSearch}%")
        ->paginate(5);
        
        return view('shop', compact('products'));
    }
}
