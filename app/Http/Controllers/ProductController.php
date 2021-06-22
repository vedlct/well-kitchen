<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sku;
use App\Models\VariationDetails;
use App\Models\Customer;
use App\Models\Review;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $sku = Sku::with('product', 'variationImages')->findOrfail($id);
        $relatedProducts = Product::where('categoryId', $sku->product->categoryId)->pluck('productId');
        $skus = Sku::whereIn('fkproductId', $relatedProducts)->with('product')->get()->unique('fkproductId');
        $product = Product::where('productId', $sku->fkproductId)->with('review.customer.user','category')->first();
        $finalRating = 0;
        if(Auth::check()){
            $customer = Customer::where('fkuserId',Auth::user()->userId)->with('user')->first();
            $reviewAll = Review::with('customer.user','getRating')->where('fkproductId',$product->productId)->orderBy('created_at','desc')->limit(10)->get();
            $reviews = Review::where('fkproductId', $sku->fkproductId)->get();

            if($reviews->count() > 0 ) {
                $totalRating = 0;
                $totalCustomer = 0;

                foreach ($reviews->unique('customerID') as $review) {
                    $totalRating += $review->getRating->value;
                    $totalCustomer++;
                }
                $finalRating = ceil($totalRating / $totalCustomer);
            }
            return view('productDetails', compact('sku', 'product','skus','customer','reviewAll', 'finalRating'));
        }else{
            $reviews = Review::where('fkproductId', $sku->fkproductId)->get();
            $review = Review::with('customer.user','getRating')->where('fkproductId',$product->productId)->orderBy('created_at','desc')->limit(10)->get();

            if($reviews->count() > 0 ) {
                $totalRating = 0;
                $totalCustomer = 0;

                foreach ($reviews->unique('customerID') as $review) {
                    $totalRating += $review->getRating->value;
                    $totalCustomer++;
                }
                $finalRating = ceil($totalRating / $totalCustomer);
            }
            $review = Review::with('customer.user','getRating')->where('fkproductId',$product->productId)->orderBy('created_at','desc')->limit(10)->get();
            return view('productDetails', compact('sku', 'product','skus','review', 'finalRating'));
        }




//        return view('productDetails', compact('sku', 'product','skus','customer','review', 'finalRating'));
    }

    public function colorChoose(Request $request)
    {
        $variationRelation= VariationDetails::where('variationRelationId', $request->variationRelationId)->first();
        $sku = Sku::where('skuId', $variationRelation->skuId)->first();

        $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first();
        $afterDiscountPrice = null;
        if(!empty($hotDeal)){
            $percentage = $hotDeal->hotdeals->percentage;
            $afterDiscountPrice = ($sku->salePrice) - (($sku->salePrice)*$percentage)/100;
        }

        $otherVariationSameSku = VariationDetails::where('skuId', $variationRelation->skuId)->get()->except($variationRelation->variationRelationId);
        $variationDatas = [];
        foreach ($otherVariationSameSku->unique('variationData') as $variationR) {
            if ($variationR->variationDetailsdata) {
                $variationDatas[] = $variationR;
            }
        }

        return response()->json(['otherVariationSameSku'=>$otherVariationSameSku, 'sku'=> $sku, 'afterDiscountPrice'=>$afterDiscountPrice, 'variationDatas'=>$variationDatas ]);
    }

    public function compare($skuId){
        $sku = Sku::where('skuId', $skuId)->first();
        $reviews = Review::where('fkproductId', $sku->fkproductId)->get();
        $finalRating = 0;
        if($reviews->count() > 0 ) {
            $totalRating = 0;
            $totalCustomer = 0;

            foreach ($reviews->unique('customerID') as $review) {
                $totalRating += $review->getRating->value;
                $totalCustomer++;
            }
            $finalRating = ceil($totalRating / $totalCustomer);
        }
//        $finalRating = ceil($ratingPerCustomer/5);

        return view('compare', compact('sku', 'reviews', 'finalRating'));
    }

    public function compareSearch(Request $request){

        $product = Product::with('sku', 'category', 'brand', 'details')
                            ->where('productName', 'LIKE', "%{$request->searchTxt}%")
                            ->orWhere('productCode', 'LIKE', "%{$request->searchTxt}%")
                            ->orWhere('tag', 'LIKE', "%{$request->searchTxt}%")
                            ->first();
        $reviewsCount = Review::where('fkproductId', $product->productId)->count();
        $reviews = Review::where('fkproductId', $product->productId)->get();
        $finalRating = 0;
        if($reviews->count() > 0 ) {
            $totalRating = 0;
            $totalCustomer = 0;

            foreach ($reviews->unique('customerID') as $review) {
                $totalRating += $review->getRating->value;
                $totalCustomer++;
            }
            $finalRating = ceil($totalRating / $totalCustomer);
        }

        return response()->json(['product'=>$product, 'revCount'=>$reviewsCount, 'finalRating'=>$finalRating]);


//              $allSearch = $request->allSearch;
//        $products = Product::query()
//            ->where('productName', 'LIKE', "%{$allSearch}%")
//            ->orWhere('productCode', 'LIKE', "%{$allSearch}%")
//            ->orWhere('tag', 'LIKE', "%{$allSearch}%")
//            ->with('sku')
//            ->get();
    }

//    public function sizeChoose(Request $request)
//    {
//        dd($request->all());
//        return 'fsadfa';
//    }

}

