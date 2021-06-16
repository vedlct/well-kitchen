<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sku;
use App\Models\VariationDetails;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $sku = Sku::with('product', 'variationImages')->findOrfail($id);
        $relatedProducts = Product::where('categoryId', $sku->product->categoryId)->pluck('productId');
        $skus = Sku::whereIn('fkproductId', $relatedProducts)->with('product')->get()->unique('fkproductId');
        $product = Product::where('productId', $sku->fkproductId)->with('review.customer.user')->first();
        // @dd($product->review);
        // foreach ($product->review as $k){
        //       dd($k->customer->user->firstName);
        // }

        return view('productDetails', compact('sku', 'product','skus'));
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

//    public function sizeChoose(Request $request)
//    {
//        dd($request->all());
//        return 'fsadfa';
//    }

}

