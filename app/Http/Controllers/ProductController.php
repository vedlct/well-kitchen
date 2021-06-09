<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sku;
use App\Models\VariationDetails;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $sku = Sku::with('product', 'variationImages')->findOrfail($id);
        $product = Product::where('productId', $sku->fkproductId)->first();
        return view('productDetails', compact('sku', 'product'));
    }

    public function colorChoose(Request $request)
    {
//        dd($request->all());
        $variationRelation= VariationDetails::where('variationRelationId', $request->variationRelationId)->first();
        $sku = Sku::where('skuId', $variationRelation->skuId)->first();
        $otherVariationSameSku = VariationDetails::where('skuId', $variationRelation->skuId)->get()->except($variationRelation->variationRelationId);
        $variationDatas = [];
        foreach ($otherVariationSameSku->unique('variationData') as $variationR) {
            if ($variationR->variationDetailsdata) {
                $variationDatas[] = $variationR;
            }
        }

        return response()->json(['otherVariationSameSku'=>$otherVariationSameSku, 'sku'=> $sku, 'variationDatas'=>$variationDatas ]);
    }

    public function sizeChoose(Request $request)
    {
        dd($request->all());
        return 'fsadfa';
    }

//    public function changeColor(Request $request)
//    {
//        $allvariation = [];
//        $variationSkus = VariationRelationData::where('producID', $request->productId)->where('variationData', $request->variationData)->pluck('skuID');
//        $variations = VariationRelationData::whereIn('skuID', $variationSkus)->get();
//        $productSkus = Sku::where('fkproductId', $request->productId)->where('status', 'active')->pluck('skuId');
//        $productImages = ProductImage::whereIn('fkskuId', $productSkus)->get();
//        $imageSku = ProductImage::whereIn('fkskuId', $variationSkus)->pluck('fkskuId')->first();
//
//        foreach ($variations->unique('variationData') as $variation) {
//            if ($variation->variationDetails->variationType != "Color" && $variation->variationDetails->selectionType == "checkbox") {
//                $allvariation[] = $variation;
//            }
//        }
//
//        //price for max stock available batch
////        $variationSkus = VariationRelationData::where('producID', $request->productId)->where('variationData', $request->variationData)->pluck('skuID');
//
//        $batches = StockRecord::whereIn('fkskuId', $variationSkus)->pluck('batchId')->unique();
//        $salePrice = productHelper::salePrice($batches);
//
////        Stock
//        $totalstock = StockRecord::whereIn('fkskuId', $variationSkus)->where('type', 'in')->sum('stock');
//        $outstock = StockRecord::whereIn('fkskuId', $variationSkus)->where('type', 'out')->sum('stock');
//        $availableStock = $totalstock - $outstock;
//
//        return response()->json(['variations' => $allvariation, 'productImages' => $productImages, 'availableStock' => $availableStock, 'imageSku' => $imageSku, 'salePrice' => $salePrice, 'Skus' => $variationSkus]);
//    }

}

