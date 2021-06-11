<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sku;
use App\Models\ProductImages;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Variation;
use App\Models\VariationDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categoryProducts($categoryId=null){

        if(empty($categoryId)){
            $skus = Sku::with('product')->where('status', 'active')->get();
        }

        if(!empty($categoryId)){
            // $skus = Sku::with('product')->where('status', 'active')->get();
            $products = Product::with('sku', 'images')->where('status', 'active')->where('categoryId', $categoryId)->pluck('productId');
            $skus = Sku::whereIn('fkproductId', $products)->get();


        }

        return view('shop', compact('skus'));
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
        dd('dfsa');

//        $skus = Sku::with('product', 'proimage')->whereHas('proimage', function ($query) {
//            $query->groupBy('fkskuId');
//        })->whereHas('product', function ($query) use ($request) {
//            $query->where('status', 'active');
//        });

        $skus = Sku::with('product')->where('status', 'active')->get();

        if (!empty($request->categoryId)) {
            $skus = $skus->whereHas('product', function ($query) use ($request) {
                $query->where('categoryId', $request->categoryId);
            });
        }

        if(!empty($request->products)){
            $skus = $skus->whereHas('product', function ($query) use ($request) {
                $query->whereIn('productId', $request->products);
            });
        }

        if (!empty($request->catSS)) {
            $skus = $skus->whereHas('product', function ($query) use ($request) {
                $query->whereIn('categoryId', $request->catSS);
            });
        }

        if (!empty($request->colorSS)) {
            $variation = VariationDetails::whereIn('variationData', $request->colorSS)->pluck('skuId');
            $skus = $skus->whereIn('skuId', $variation);
        }

        if (!empty($request->sizeSS)) {
            $variation = VariationDetails::whereIn('variationData', $request->sizeSS)->pluck('skuId');
            $skus = $skus->whereIn('skuId', $variation);
        }
        $skus = $skus->get();
        $productSkus = [];
        foreach ($skus as $sku) {
            $productSkus[] = $sku->skuId;
        }

//        price for max stock available batch

        $batch = [];

//        foreach ($productSkus as $productSku) {
//            $batches = StockRecord::where('fkskuId', $productSku)->pluck('batchId')->unique();
//
//            $stockAvailable = [];
//
//            foreach ($batches as $batchId) {
//                $inStock = StockRecord::where('batchId', $batchId)->where('type', 'in')->sum('stock');
//                $outStock = StockRecord::where('batchId', $batchId)->where('type', 'out')->sum('stock');
//                $stockAvailable[$batchId] = $inStock - $outStock;
//            }
//
//            if (!empty($stockAvailable)) {
//                $maxStock = max($stockAvailable);
//                $batchId = array_keys($stockAvailable, $maxStock);
//                $bid = $batchId[0];
//                $batchSku = Batch::where('batchId', $bid)->pluck('skuId')->first();
//                $batch[$batchSku] = Batch::where('batchId', $batchId)->pluck('salePrice')->first();
//            }
//        }

//        return view('frontend.pages.product-details-ajax', compact('skus'));
    }
}
