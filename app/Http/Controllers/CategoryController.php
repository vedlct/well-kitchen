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

        if(empty($categoryId)){
            $skus = Sku::with('product')->where('status', 'active')->groupBy('fkproductId')->paginate(2);
            $totalAvailable = 0;
            foreach($skus->unique('fkproductId') as $sku){
                $stockIn=Stock::where('fkskuId',$sku->skuId)->where('type', 'in')->sum('stock');
                $stockOut=Stock::where('fkskuId',$sku->skuId)->where('type', 'out')->sum('stock');
                $stockAvailable = $stockIn-$stockOut;
                if($stockAvailable > 0){
                    $totalAvailable += 1;
                }
            }
        }

        if(!empty($categoryId)){
            $totalAvailable = 0;
            $products = Product::with('sku', 'images')->where('status', 'active')->where('categoryId', $categoryId)->pluck('productId');
            $skus = Sku::whereIn('fkproductId', $products)->groupBy('fkproductId')->paginate(2);
            foreach($skus->unique('fkproductId') as $sku){
                $stockIn=Stock::where('fkskuId',$sku->skuId)->where('type', 'in')->sum('stock');
                $stockOut=Stock::where('fkskuId',$sku->skuId)->where('type', 'out')->sum('stock');
                $stockAvailable = $stockIn-$stockOut;
                if($stockAvailable > 0){
                    $totalAvailable += 1;
                }
            }
        }
        $newArrived = Product::where('newarrived', 1)->count();
        $category = Category::where('categoryId', $categoryId)->first();

        return view('shop', compact('skus', 'newArrived', 'totalAvailable', 'categoryId', 'category'));
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
            $skus = Sku::with('product')->where('salePrice', '>=', $request->priceMin)->where('salePrice', '<=', $request->priceMax)->where('status', 'active');
        }else {
            $skus = Sku::with('product')->where('status', 'active');
        }

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

        if (!empty($request->saleSS)) {
            $hotDealProdcuts = HotDealsProduct::with('hotdeals')->get();
            $hotDealProdcuts = $hotDealProdcuts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'));
            $hotDealProdcutIds = $hotDealProdcuts->pluck('fkproductId');
            $skus = $skus->whereIn('fkproductId', $hotDealProdcutIds);
        }

        if (!empty($request->newSS)) {
            $skus = $skus->whereHas('product', function ($query) use ($request) {
                $query->where('newarrived', '1');
            });
        }

        if (!empty($request->instockSS) || (!empty($request->alphaOrderSS) && ($request->alphaOrderSS=="instock"))) {
            $availableSku = [];
            foreach($skus->get() as $sku){
                $stockIn=Stock::where('fkskuId',$sku->skuId)->where('type', 'in')->sum('stock');
                $stockOut=Stock::where('fkskuId',$sku->skuId)->where('type', 'out')->sum('stock');
                $stockAvailable = $stockIn-$stockOut;
                if($stockAvailable > 0){
                    $availableSku[] = $sku->skuId;
                }
            }
            $skus = $skus->whereIn('skuId', $availableSku);
        }
        

        if (!empty($request->alphaOrderSS) && $request->alphaOrderSS == "A") {
                $skus = $skus->sortBy('product.productName');
        }

        if (!empty($request->alphaOrderSS) && $request->alphaOrderSS == "Z") {
                $skus = $skus->sortByDesc('product.productName');
        }

        $skus = $skus->groupBy('fkproductId')->paginate(2);
        return view('shopAjax', compact('skus'));
    }
}
