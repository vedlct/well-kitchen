<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HotDealsProduct;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Stock;
use App\Models\Variation;
use App\Models\VariationDetails;
use Illuminate\Http\Request;
use Session;
use DB;

class CategoryController extends Controller
{
    public function categoryProducts($slug = null)
    {
        // dd($categoryId);
        $categoryIdFind=Category::where('slug', $slug)->first();
        $categoryId = $categoryIdFind->categoryId;

        $parentCategory = null;
        $subCategory = null;
        $minmaxPrice =  null;

        $skuss = Sku::with('product')->whereHas('product', function ($query) use ($categoryId) {
            $query->where('status', 'active')->where('categoryId', $categoryId);
        })->get();

        $skuIds = Sku::with('product')->whereHas('product', function ($query) use ($categoryId) {
            $query->where('status', 'active')->where('categoryId', $categoryId);
        })->pluck('skuId');

        $variations = VariationDetails::whereIn('skuId', $skuIds)->get();
        $variationDatas = VariationDetails::whereIn('skuId', $skuIds)->pluck('variationData');
        $variationColorIds = Variation::whereIn('variationId', $variationDatas)->where('variationType', 'Color')->get();
        $variationSizeIds = Variation::whereIn('variationId', $variationDatas)->where('variationType', 'Size')->get();

        $newArrived = Product::where('newarrived', 1)->count();
        $category = Category::where('categoryId', $categoryId)->first();
        if ($category) {

            $parentCategory = Category::where('categoryId', $category->parent)->first();
            $subCategory = Category::where('categoryId', $category->subParent)->first();

            $minmaxPrice = \DB::table('product')
                ->select(\DB::raw("MAX(sku.salePrice) AS max_price"), \DB::raw("MIN(sku.salePrice) AS min_price"))
                // ->leftJoin('category', 'product.categoryId', '=', 'category.categoryId')
                ->join('sku', 'product.productId', '=', 'sku.fkproductId')
                ->where('product.categoryId', $categoryId)
                ->groupBy('product.categoryId')
                ->first();

            // dd($skuss);

        }

        return view('shop', compact('newArrived', 'categoryId', 'variations', 'variationColorIds', 'variationSizeIds', 'parentCategory', 'minmaxPrice', 'subCategory', 'category', 'skuss'));
    }

    public function featureviewAll()
    {
        $recommendeds = Sku::with('product')->whereHas('product', function ($query) {
            $query->where('status', 'active')->where('isrecommended', 1);
        })->get();
        return view('feature', compact('recommendeds'));
    }

    // public function searchByProducts(Request $request)
    // {
    //     // dd($request->all());
    //     $parentCategory = null;
    //     $subCategory = null;
    //     $minmaxPrice =  null;
    //     // dd($request->all());
    //     $allSearch = $request->allSearch;
    //     $products = Product::query()
    //     ->where('status', 'active')
    //     ->where('productName', 'LIKE', "%{$allSearch}%")
    //     ->orWhere('productCode', 'LIKE', "%{$allSearch}%")
    //     ->orWhere('tag', 'LIKE', "%{$allSearch}%")
    //     ->with('sku')
    //     ->get();
    //     $skusIds = [];
    //     if ($products->count() > 0) {
    //         foreach ($products as $product) {
    //             foreach ($product->sku as $productsku) {
    //                 $skusIds[] = $productsku->skuId;
    //             }
    //         }

    //         $skuss = Sku::with('product')->whereIn('skuId', $skusIds)->whereHas('product', function ($query) {
    //             $query->where('status', 'active');
    //         })->get();

    //         $categoryId = $skuss->first()->product->categoryId;

    //         $category = $skuss->first()->product->category;

    //         $skuIds = Sku::with('product')->whereIn('skuId', $skusIds)->whereHas('product', function ($query) use ($category) {
    //             $query->where('status', 'active')->where('categoryId', $category->categoryId);
    //         })->get();
    //         // $variations = VariationDetails::whereIn('skuId', $skuIds)->get();
    //         // $variationDatas = VariationDetails::whereIn('skuId', $skuIds)->pluck('variationData');
    //         // $variationColorIds = Variation::whereIn('variationId', $variationDatas)->where('variationType', 'Color')->get();
    //         // $variationSizeIds = Variation::whereIn('variationId', $variationDatas)->where('variationType', 'Size')->get();


    //         if ($category) {

    //             $parentCategory = Category::where('categoryId', $category->parent)->first();
    //             $subCategory = Category::where('categoryId', $category->subParent)->first();

    //             $minmaxPrice = \DB::table('product')
    //                 ->select(\DB::raw("MAX(sku.salePrice) AS max_price"), \DB::raw("MIN(sku.salePrice) AS min_price"))
    //                 // ->leftJoin('category', 'product.categoryId', '=', 'category.categoryId')
    //                 ->join('sku', 'product.productId', '=', 'sku.fkproductId')
    //                 ->where('product.categoryId', $categoryId)
    //                 ->groupBy('product.categoryId')
    //                 ->first();
    //         }

    //         // dd($skuss);
    //         return view('shop', compact('products', 'skuss', 'categoryId', 'category', 'parentCategory', 'minmaxPrice', 'subCategory',));
    //     } else {
    //         Session::flash('warning', 'No product matched');
    //         return redirect('/');
    //     }
    // }

    public function searchByProducts(Request $request)
    {
        // dd($request->all());
        $parentCategory = null;
        $subCategory = null;
        $minmaxPrice =  null;
        // dd($request->all());
        $allSearch = $request->allSearch;
        $products = Product::query()
        ->where('status', 'active')
        ->where('productName', 'LIKE', "%{$allSearch}%")
        ->orWhere('productCode', 'LIKE', "%{$allSearch}%")
        ->orWhere('tag', 'LIKE', "%{$allSearch}%")
        ->with('sku')
        ->get();
        $skusIds = [];
        if ($products->count() > 0) {
            foreach ($products as $product) {
                foreach ($product->sku as $productsku) {
                    $skusIds[] = $productsku->skuId;
                }
            }

            $skuss = Sku::with('product')->whereIn('skuId', $skusIds)->whereHas('product', function ($query) {
                $query->where('status', 'active');
            })->get();
        //    dd($skuss);
            $categoryId = $skuss->first()->product->categoryId;

            $category = $skuss->first()->product->category;




            if ($category) {

                $parentCategory = Category::where('categoryId', $category->parent)->first();
                $subCategory = Category::where('categoryId', $category->subParent)->first();

                $minmaxPrice = \DB::table('product')
                    ->select(\DB::raw("MAX(sku.salePrice) AS max_price"), \DB::raw("MIN(sku.salePrice) AS min_price"))
                    // ->leftJoin('category', 'product.categoryId', '=', 'category.categoryId')
                    ->join('sku', 'product.productId', '=', 'sku.fkproductId')
                    ->where('product.categoryId', $categoryId)
                    ->groupBy('product.categoryId')
                    ->first();
            }

            // dd($skuss);
            return view('shop', compact('products', 'skuss', 'categoryId', 'category', 'parentCategory', 'minmaxPrice', 'subCategory',));
        } else {
            Session::flash('warning', 'No product matched');
            return redirect('/');
        }
    }



    public function filterProducts(Request $request)
    {
        // dd($request->all());

        $skuss = Sku::with('product')->whereHas('product', function ($query) {
            $query->where('status', 'active');
        });

        if (!empty($request->priceMin) && !empty($request->priceMax)) {
            $skuss = $skuss->where('salePrice', '>=', $request->priceMin)->where('salePrice', '<=', $request->priceMax);
        }

        if (!empty($request->categoryId)) {
            $skuss = $skuss->whereHas('product', function ($query) use ($request) {
                $query->where('categoryId', $request->categoryId);
            });
        }



        if (!empty($request->products)) {
            $skuss = $skuss->whereHas('product', function ($query) use ($request) {
                $query->whereIn('productId', $request->products);
            });
        }

        if (!empty($request->catSS)) {
            $skuss = $skuss->whereHas('product', function ($query) use ($request) {
                $query->whereIn('categoryId', $request->catSS);
            });
        }

        if (!empty($request->colorSS)) {
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



        if (!empty($request->instockSS) || (!empty($request->alphaOrderSS) && ($request->alphaOrderSS == "instock"))) {
            $availableSku = [];
            foreach ($skuss->get() as $sku) {
                $stockIn = Stock::where('fkskuId', $sku->skuId)->where('type', 'in')->sum('stock');
                $stockOut = Stock::where('fkskuId', $sku->skuId)->where('type', 'out')->sum('stock');
                $stockAvailable = $stockIn - $stockOut;
                if ($stockAvailable > 0) {
                    $availableSku[] = $sku->skuId;
                }
            }

            $skuss = $skuss->whereIn('skuId', $availableSku);
        }

        $per_paginate = 16;
        $skip = ($request->page - 1) * $per_paginate;
        if ($skip < 0) {
            $skip = 0;
        }

        $skuss = $skuss->skip($skip)->paginate($per_paginate);

        $view = view('shopAjax', compact('skuss'))->render();
        return response()->json(['html' => $view, 'skuss' => $skuss]);
    }

    public function filterProductsPrice(Request $request)
    {
        // dd($request->all());
        // price filter
        $skuss = Sku::with('product')->whereHas('product', function ($query) {
            $query->where('status', 'active');
        });

        if (!empty($request->categoryId)) {
            $skuss = $skuss->whereHas('product', function ($query) use ($request) {
                $query->where('categoryId', $request->categoryId);
            });
        }
        // dd($skuss);
        if (!empty($request->price) && $request->price == 'High to Low') {
            $skuss = $skuss->orderBy('regularPrice', 'DESC')->where('status', 'active')->get();
            // $per_paginate = 6;
            // $skip = ($request->page - 1) * $per_paginate;
            // if ($skip < 0) {
            //     $skip = 0;
            // }

            // $skuss = $skuss->skip($skip)->paginate($per_paginate);
        }
        if (!empty($request->price) && $request->price == 'Low to High') {
            $skuss = $skuss->orderBy('regularPrice', 'ASC')->where('status', 'active')->get();
            // $per_paginate = 6;
            // $skip = ($request->page - 1) * $per_paginate;
            // if ($skip < 0) {
            //     $skip = 0;
            // }

            // $skuss = $skuss->skip($skip)->paginate($per_paginate);
        }

        if (!empty($request->price) && $request->price == 'a-z') {
            $skuss = $skuss->with('product')->get()->sortBy('product.productName');
        }
        if (!empty($request->price) && $request->price == 'z-a') {
            $skuss = $skuss->with('product')->get()->sortByDesc('product.productName');

        }

        if (!empty($request->price) && $request->price == 'instock') {
            $availableSku = [];
            foreach ($skuss->get() as $sku) {
                $stockIn = Stock::where('fkskuId', $sku->skuId)->where('type', 'in')->sum('stock');
                $stockOut = Stock::where('fkskuId', $sku->skuId)->where('type', 'out')->sum('stock');
                $stockAvailable = $stockIn - $stockOut;
                if ($stockAvailable > 0) {
                    $availableSku[] = $sku->skuId;
                }
            }

            $skuss = $skuss->whereIn('skuId', $availableSku)->get();
        }

        $view = view('shopAjax', compact('skuss'))->render();
        return response()->json(['html' => $view, 'skuss' => $skuss]);
    }
}
