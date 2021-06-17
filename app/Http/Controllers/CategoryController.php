<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HotDealsProduct;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Stock;
use App\Models\VariationDetails;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryProducts($categoryId=null){

//        if(empty($categoryId)){
            $skus = Sku::with('product')->where('status', 'active')->get();

        $newArrived = Product::where('newarrived', 1)->count();
        $category = Category::where('categoryId', $categoryId)->first();

        return view('shop', compact('newArrived', 'categoryId', 'category', 'skus'));
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

    public function filterProducts(Request $request){
        if($request->priceMin && $request->priceMax) {
            $skuss = Sku::with('product')->where('salePrice', '>=', $request->priceMin)->where('salePrice', '<=', $request->priceMax)->where('status', 'active');
        }else {
            $skuss = Sku::with('product')->where('status', 'active');
        }

        if (!empty($request->categoryId)) {
            $skuss = $skuss->whereHas('product', function ($query) use ($request) {
                $query->where('categoryId', $request->categoryId);
            });
        }

        if(!empty($request->products)){
            $skuss = $skuss->whereHas('product', function ($query) use ($request) {
                $query->whereIn('productId', $request->products);
            });
        }

        if (!empty($request->catSS)) {
            $skuss = $skuss->whereHas('product', function ($query) use ($request) {
                $query->whereIn('categoryId', $request->catSS);
            });
        }

        if (!empty($request->colorSS) ) {
            $variation = VariationDetails::whereIn('variationData', $request->colorSS)->pluck('skuId');
            $skuss = $skuss->whereIn('skuId', $variation);
        }
        if (!empty($request->colorSS) && !empty($request->page)) {
            $variation = VariationDetails::whereIn('variationData', $request->colorSS)->pluck('skuId');
            $skuss = $skuss->whereIn('skuId', $variation);

        }

        if (!empty($request->sizeSS)) {
            $variation = VariationDetails::whereIn('variationData', $request->sizeSS)->pluck('skuId');
            $skuss = $skuss->whereIn('skuId', $variation);
        }

        if (!empty($request->saleSS)) {
            $hotDealProdcuts = HotDealsProduct::with('hotdeals')->get();
            $hotDealProdcuts = $hotDealProdcuts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'));
            $hotDealProdcutIds = $hotDealProdcuts->pluck('fkproductId');
            $skuss = $skuss->whereIn('fkproductId', $hotDealProdcutIds);
        }

        if (!empty($request->newSS)) {
            $skuss = $skuss->whereHas('product', function ($query) use ($request) {
                $query->where('newarrived', '1');
            });
        }

        if (!empty($request->instockSS) || (!empty($request->alphaOrderSS) && ($request->alphaOrderSS=="instock"))) {
            $availableSku = [];
            foreach($skuss->get() as $sku){
                $stockIn=Stock::where('fkskuId',$sku->skuId)->where('type', 'in')->sum('stock');
                $stockOut=Stock::where('fkskuId',$sku->skuId)->where('type', 'out')->sum('stock');
                $stockAvailable = $stockIn-$stockOut;
                if($stockAvailable > 0){
                    $availableSku[] = $sku->skuId;
                }
            }
            $skuss = $skuss->whereIn('skuId', $availableSku);
        }

           $per_paginate = 1;
           $skip = ($request->page - 1) * $per_paginate;
           if ($skip < 0) {
               $skip = 0;
           }

        $skuss = $skuss->skip($skip)->paginate($per_paginate);

        $view = view('shopAjax', compact('skuss'))->render();
        return response()->json(['html'=>$view, 'skuss'=>$skuss]);

    }
}
