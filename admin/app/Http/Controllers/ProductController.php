<?php

namespace App\Http\Controllers;

use File;
use Image;
use Session;
use App\Models\Sku;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\ProductDetails;
use App\Models\VariationDetails;
use App\Models\ProductVariationTemp;

class ProductController extends Controller
{
    //Product List Page
    public function show()
    {
        return view('product.index');
    }

    //All Product Ajax Return
    public function list()
    {
        $product = Product::all();
        return datatables()->of($product)
            ->addColumn('featureImage', function ($image) {
                if (isset($image->featureImage)) {
                    return '<img src="'.url('public/featureImage/'.$image->featureImage).'" border="0" width="40" class="img-rounded" align="center" />';
                } else {
                    return 'No image';
                }
            })
            ->addColumn('status', function ($status) {
                if ($status->status == 'active') {
                    return '<label class="btn-sm btn-success">'.ucfirst($status->status).'</label>';
                } elseif ($status->status == 'inactive') {
                    return '<label class="btn-sm btn-danger">'.ucfirst($status->status).'</label>';
                }
            })
            ->addColumn('category', function ($product) {
                if ($product->category) {
                    return $product->category->categoryName;
                } else {
                    return 'null';
                }
            })
            ->addColumn('brand', function ($product) {
                if ($product->brand) {
                    return $product->brand->brandName;
                } else {
                    return 'null';
                }
            })
            ->rawColumns(['category', 'brand', 'status', 'featureImage'])
            ->setRowAttr([
                'align' => 'center',
            ])->make(true);
    }

    //Product Create Page
    public function create()
    {
        Session::put('uniqueSession', uniqid());
        $categories = Category::all();
        $brands = Brand::where('status', 'active')->get();
        $units = Unit::all();
        $variations = Variation::all();
        $variationTypes = Variation::pluck('variationType');

        return view('product.create', compact('categories', 'brands', 'units', 'variationTypes', 'variations'));
    }

    //Find Sub-Category
    public function findSubCategory(Request $request)
    {
        $subcategories = Category::where('parent', $request->categoryId)->get();

        return response()->json(['subcategories' => $subcategories]);
    }

    //Temp Variation Store
    public function variationStore(Request $request)
    {
        $this->validate($request, [
            'variationType1' => 'required_without:variationType2|different:variationType2',
            'variationType2' => 'required_without:variationType1|different:variationType1',
            'variationValue1' => 'required_with:variationType1',
            'variationValue2' => 'required_with:variationType2',
            'salePrice' => 'required',

        ]);
        $sessionId = Session::get('uniqueSession');
        $product_variation_temp = new ProductVariationTemp();
        $product_variation_temp->barcode = $request->barcode;
        $product_variation_temp->sessionId = $sessionId;
        $product_variation_temp->variationType1 = $request->variationType1;
        $product_variation_temp->variationType2 = $request->variationType2;
        $product_variation_temp->salePrice = $request->salePrice;
        $product_variation_temp->stockAlert = $request->stockAlert;

        if ($request->variationValue1) {
            $variation1 = Variation::where('variationId', $request->variationValue1)->first();
            $product_variation_temp->variationValue1 = $variation1->variationValue;
            $product_variation_temp->variationId1 = $variation1->variationId;
        }

        if ($request->variationValue2) {
            $variation2 = Variation::where('variationId', $request->variationValue2)->first();
            $product_variation_temp->variationValue2 = $variation2->variationValue;
            $product_variation_temp->variationId2 = $variation2->variationId;
        }

        if ($request->hasFile('variationImage')) {
            foreach ($request->file('variationImage') as $vimage) {
                $originalExtension = $vimage->getClientOriginalExtension();
                $uniqueImageName = rand(100, 999).'.'.$originalExtension;
                $image = Image::make($vimage);
                $image->save(public_path().'/productImages/'.$uniqueImageName);
                $data[] = $uniqueImageName;
            }
        }
        if (!empty($data)) {
            $product_variation_temp->variationImage = json_encode($data);
        }
        $product_variation_temp->save();
        $product_variations = ProductVariationTemp::where('sessionId', $product_variation_temp->sessionId)->get();
        $view = view('product.tempVariationAjax', compact('product_variations'))->render();

        return response()->json(['html' => $view]);
    }

    //Product Store
    public function store(Request $request)
    {
        $this->validate($request, [
            'productName' => 'required|unique:product',
            'productCode' => 'required|unique:product',
            // 'barcode' => 'required|unique:sku',
        ]);
        $product = new Product();
        $product->productCode = $request->productCode;
        $product->productName = $request->productName;
        $product->slug = $request->slug;
        $product->tag = $request->tag;
        $product->categoryId = $request->categoryId;
        $product->fkbrandId = $request->fkbrandId;
        $product->fkidproduct_unit = $request->fkidproduct_unit;
        $product->type = $request->type;
        $product->status = $request->status;
        if($request->newArrival){
            $product->newarrived='1';
        }
        if ($request->featureProduct) {
            $product->isrecommended='1';
        }
        $product->save();

        if ($request->hasFile('featureImage')) {
            $originalExtension = $request->featureImage->getClientOriginalExtension();
            $uniqueImageName = $product->productId.rand(100, 999).'.'.$originalExtension;
            $image = Image::make($request->featureImage);
            $image->save(public_path().'/featureImage/'.$uniqueImageName);
            $product->featureImage = $uniqueImageName;
            $product->save();
        }

        if (!empty($request->productDetails)) {
            $productDetails = new ProductDetails();
            $productDetails->description = $request->productDetails;
            $productDetails->fabricDetails = $request->shortDescription;
            $productDetails->productId = $product->productId;
            $productDetails->save();
        }

        if($product->type == "single"){

            $sku = new Sku();
            $sku->barcode = $request->barcode;
            $sku->fkproductId = $product->productId;
            $sku->salePrice = $request->salePrice;
            $sku->stockAlert = $request->stockAlert;
            $sku->status = $product->status;
            $sku->save();

            if ($request->hasFile('productImages')) {
                foreach ($request->file('productImages') as $pimage) {
                    $productImage = new ProductImages();
                    $productImage->fkskuId = $sku->skuId;
                    $productImage->fkProductId = $product->productId;
                    $originalExtension = $pimage->getClientOriginalExtension();
                    $productImage->imageType = $originalExtension;
                    $uniqueImageName = $sku->skuId.rand(100, 999).'.'.$originalExtension;
                    $image = Image::make($pimage);
                    $image->save(public_path().'/productImages/'.$uniqueImageName);
                    $productImage->image = $uniqueImageName;
                    $productImage->save();
                }
            }

            if ($request->hasFile('featureImage')) {
                $productImage = new ProductImages();
                $productImage->fkskuId = $sku->skuId;
                $productImage->fkProductId = $product->productId;
                $originalExtension = $request->featureImage->getClientOriginalExtension();
                $productImage->imageType = $originalExtension;
                $uniqueImageName = $sku->skuId.rand(100, 999).'.'.$originalExtension;
                $image = Image::make($request->featureImage);
                $image->save(public_path().'/productImages/'.$uniqueImageName);
                $productImage->image = $uniqueImageName;
                $productImage->save();
            }
        }

        if ($product->type == 'variation') {
            $sessionId = Session::get('uniqueSession');
            $product_variations = ProductVariationTemp::where('sessionId', $sessionId)->get();
            if(!empty($product_variations)){
                foreach($product_variations as $product_variation) {
                    //sku store
                    $sku = new Sku();
                    $sku->barcode = $product_variation->barcode;
                    $sku->fkproductId = $product->productId;
                    $sku->salePrice = $product_variation->salePrice;
                    $sku->stockAlert = $product_variation->stockAlert;
                    $sku->status = $product->status;
                    $sku->save();

                    if ($product_variation->variationValue1) {
                        $variationRelation = new VariationDetails();
                        $variationRelation->skuId = $sku->skuId;
                        $variationRelation->productId = $product->productId;
                        $variationRelation->variationData = $product_variation->variationId1;
                        $variationRelation->save();
                    }

                    if ($product_variation->variationValue2) {
                        $variationRelation = new VariationDetails();
                        $variationRelation->skuId = $sku->skuId;
                        $variationRelation->productId = $product->productId;
                        $variationRelation->variationData = $product_variation->variationId2;
                        $variationRelation->save();
                    }

                    //product image store
                    foreach (json_decode($product_variation->variationImage) as $vimage) {
                        $productImage = new ProductImages();
                        $productImage->fkskuId = $sku->skuId;
                        $productImage->fkProductId = $product->productId;
                        $productImage->imageType = substr(strrchr($vimage, '.'), 1);
                        rename(public_path().'/productImages/'.$vimage, public_path().'/productImages/'.$sku->skuId.$vimage);
                        $productImage->image = $sku->skuId.$vimage;
                        $productImage->save();
                    }
                }
            }
            ProductVariationTemp::where('sessionId', $sessionId)->delete();

            if ($request->hasFile('featureImage')) {
                $productImage = new ProductImages();
                $productImage->fkskuId = $sku->skuId;
                $productImage->fkProductId = $product->productId;
                $originalExtension = $request->featureImage->getClientOriginalExtension();
                $productImage->imageType = $originalExtension;
                $uniqueImageName = $sku->skuId.rand(100, 999).'.'.$originalExtension;
                $image = Image::make($request->featureImage);
                $image->save(public_path().'/productImages/'.$uniqueImageName);
                $productImage->image = $uniqueImageName;
                $productImage->save();
            }
        }
        Session::flash('success', 'Product Created Successfully');

        return back();
    }

    //Product Edit Page
    public function edit($productId)
    {
        Session::put('uniqueSession', uniqid());
        $categories = Category::all();
        $brands = Brand::where('status', 'active')->get();
        $units = Unit::all();
        $variations = Variation::all();
        $product = Product::with('images')->where('productId', $productId)->first();
        $sku = '';
        if ($product->type == 'single') {
            $sku = Sku::where('fkproductId', $productId)->first();
        }

        return view('product.edit', compact('product', 'sku', 'categories', 'brands', 'units', 'variations'));
    }

    //Variation List Ajax Return
    public function variationAjax(Request $request)
    {
        $products = Product::with('sku', 'sku.variationRelation', 'sku.variationRelation.variationDetailsdata', 'sku.variationImage')->where('productId', $request->productId)->first();

        return view('product.tempVariationAjax', compact('products'));
    }

    //Variation Edit Page
    public function variationAjaxEdit(Request $request)
    {
        $variations = Variation::all();
        $variationRelation = VariationDetails::where('skuId', $request->skuId)->pluck('variationRelationId');
        $variationData = VariationDetails::where('skuId', $request->skuId)->pluck('variationData');
        $variationValue = Variation::whereIn('variationId', $variationData)->pluck('variationValue');
        $variationId = Variation::whereIn('variationId', $variationData)->pluck('variationId');
        $variationType = Variation::whereIn('variationId', $variationData)->pluck('variationType');
        $sku = Sku::with('variationRelation', 'variationRelation.variationDetailsdata')->where('skuId', $request->skuId)->first();

        return view('product.variationEdit', compact('sku', 'variationId', 'variations', 'variationRelation', 'variationData', 'variationValue', 'variationType'));
    }

    public function productImageDelete(Request $request){
        $productImage = ProductImages::where('product_imageId', $request->productImageId);
        $productImage->delete();
        return response()->json();
    }

    public function detail($id){
        $product = Product::with('images','details')->where('productId', $id)->first();
            return view('product.detail', compact('product'));
    }

    //New Variation Add
    public function variationAddNew(Request $request)
    {
        $this->validate($request, [
            'variationType1' => 'required_without:variationType2|different:variationType2',
            'variationType2' => 'required_without:variationType1|different:variationType1',
            'variationValue1' => 'required_with:variationType1',
            'variationValue2' => 'required_with:variationType2',
            'salePrice' => 'required',
        ]);
        //sku store
        $sku = new Sku();
        $sku->barcode = $request->barcode;
        $sku->fkproductId = $request->productId;
        $sku->salePrice = $request->salePrice;
        $sku->stockAlert = $request->stockAlert;
        $sku->save();

        //variation store
        if ($request->variationValue1) {
            $variationRelation = new VariationDetails();
            $variationRelation->skuId = $sku->skuId;
            $variationRelation->productId = $request->productId;
            $variationRelation->variationData = $request->variationValue1;
            $variationRelation->save();
        }

        if ($request->variationValue2) {
            $variationRelation = new VariationDetails();
            $variationRelation->skuId = $sku->skuId;
            $variationRelation->productId = $request->productId;
            $variationRelation->variationData = $request->variationValue2;
            $variationRelation->save();
        }

        if ($request->hasFile('variationImage')) {
            foreach ($request->file('variationImage') as $vimage) {
                $productImage = new ProductImages();
                $productImage->fkskuId = $sku->skuId;
                $productImage->fkProductId = $request->productId;
                $originalExtension = $vimage->getClientOriginalExtension();
                $productImage->imageType = $originalExtension;
                $uniqueImageName = $sku->skuId.rand(100, 999).'.'.$originalExtension;
                $image = Image::make($vimage);
                $image->save(public_path().'/productImages/'.$uniqueImageName);
                $productImage->image = $uniqueImageName;
                $productImage->save();
            }
        }

        $products = Product::with('sku', 'sku.variationRelation', 'sku.variationRelation.variationDetailsdata', 'sku.variationImage')->where('productId', $sku->fkproductId)->first();
        $view = view('product.tempVariationAjax', compact('products'))->render();

        return response()->json(['html' => $view]);
    }

    //Variation Type Change
    public function variationTypeChange(Request $request)
    {
        $variationRelationId1 = $request->variationRelationId1;
        $variationRelation = VariationDetails::where('variationRelationId', $variationRelationId1)->first();
        $variations = Variation::where('variationType', $request->variationType)->get();

        return view('product.variationTypeChange', compact('variations', 'variationRelationId1', 'variationRelation'));
    }

    public function variationTypeChange2(Request $request)
    {
        $variationRelationId2 = $request->variationRelationId2;
        $variationRelation = VariationDetails::where('variationRelationId', $variationRelationId2)->first();
        $variations = Variation::where('variationType', $request->variationType)->get();

        return view('product.variationTypeChange2', compact('variations', 'variationRelationId2', 'variationRelation'));
    }

    //Variation Type Change End

    //Update Variation
    public function variationUpdate(Request $request)
    {
       
        $this->validate($request, [
            'variationType1' => 'required_without:variationType2|different:variationType2',
            'variationType2' => 'required_without:variationType1|different:variationType1',
            'variationValue1' => 'required_with:variationType1',
            'variationValue2' => 'required_with:variationType2',
            'salePrice' => 'required',
        ]);
        $sku = Sku::where('skuId', $request->skuId)->first();

        if ($request->variationRelationId1) {
            $variationRelation = VariationDetails::where('variationRelationId', $request->variationRelationId1)->first();
            $variationRelation->variationData = $request->variationValue1;
            $variationRelation->save();
        }

        if ($request->variationRelationId2) {
            $variationRelation = VariationDetails::where('variationRelationId', $request->variationRelationId2)->first();
            $variationRelation->variationData = $request->variationValue2;
            $variationRelation->save();
        }

        if ($request->hasFile('variationImage')) {
            foreach ($request->file('variationImage') as $vimage) {
                $productImage = new ProductImages();
                $productImage->fkskuId = $sku->skuId;
                $productImage->fkProductId = $sku->fkproductId;
                $originalExtension = $vimage->getClientOriginalExtension();
                $productImage->imageType = $originalExtension;
                $uniqueImageName = $sku->skuId.rand(100, 999).'.'.$originalExtension;
                $image = Image::make($vimage);
                $image->save(public_path().'/productImages/'.$uniqueImageName);
                $productImage->image = $uniqueImageName;
                $productImage->save();
            }
        }

        $fkproductId = $sku->fkproductId;
        $sku->barcode = $request->barcode;
        $sku->salePrice = $request->salePrice;
        $sku->stockAlert = $request->stockAlert;
        $sku->save();

        $products = Product::with('sku', 'sku.variationRelation', 'sku.variationRelation.variationDetailsdata', 'sku.variationImage')->where('productId', $fkproductId)->first();
        $view = view('product.tempVariationAjax', compact('products'))->render();

        return response()->json(['html' => $view]);
    }

    //Update Product
    public function update(Request $request, $productId){

        $this->validate($request, [
            'productName' => 'required',
            'productCode' => 'required',
//            'barcode' => 'required|unique:barcode,'.$request->skuId,
        ]);

        $product = Product::where('productId', $productId)->first();

        $product->productCode = $request->productCode;
        $product->productName = $request->productName;
        $product->slug = $request->slug;
        $product->tag = $request->tag;
        $product->categoryId = $request->categoryId;
        $product->fkbrandId = $request->fkbrandId;
        $product->fkidproduct_unit = $request->fkidproduct_unit;
        $product->type = $request->type;
        $product->status = $request->status;


        if($request->newArrival == "on"){

            $product->newarrived='1';
            $product->isrecommended='0';
        }
        if ($request->featureProduct == "on") {
            $product->isrecommended='1';
            $product->newarrived='0';
        }
        if ($request->featureProduct == "on" && $request->newArrival == "on") {
            $product->isrecommended='1';
            $product->newarrived='1';
        }
        if ($request->featureProduct != "on" && $request->newArrival != "on") {
            $product->isrecommended='0';
            $product->newarrived='0';
        }
        // if(!empty($request->newArrival)){
        //     $product->newarrived='1';
        // }
        // if (!empty($request->featureProduct)) {
        //     $product->isrecommended='1';
        // }
        $product->save();

        if ($request->hasFile('featureImage')) {
            $originalExtension = $request->featureImage->getClientOriginalExtension();
            $uniqueImageName = $product->productId.rand(100, 999).'.'.$originalExtension;
            $image = Image::make($request->featureImage);
            $image->save(public_path().'/featureImage/'.$uniqueImageName);
            $product->featureImage = $uniqueImageName;
            $product->save();
        }

        if (!empty($request->productDetails)) {
            $productDetails = ProductDetails::where('productId',$productId)->first();
            $productDetails->description = $request->productDetails;
            $productDetails->fabricDetails = $request->shortDescription;
            $productDetails->save();
        }

        if (empty($request->productDetails)) {
            $productDetails = new ProductDetails();
            $productDetails->description = $request->productDetails;
            $productDetails->fabricDetails = $request->shortDescription;
            $productDetails->productId = $productId;
            $productDetails->save();
        }

        if ($product->type == 'single') {
            $sku = Sku::where('fkproductId', $productId)->first();
            $sku->barcode = $request->barcodeSingle;
            $sku->salePrice = $request->salePrice;
            $sku->stockAlert = $request->stockAlert;
            $sku->status = $request->status;
            $sku->save();

            if ($request->hasFile('productImages')) {
                foreach ($request->file('productImages') as $pimage) {
                    $productImage = new ProductImages();
                    $productImage->fkskuId = $sku->skuId;
                    $productImage->fkProductId = $product->productId;
                    $originalExtension = $pimage->getClientOriginalExtension();
                    $productImage->imageType = $originalExtension;
                    $uniqueImageName = $sku->skuId.rand(100, 999).'.'.$originalExtension;
                    $image = Image::make($pimage);
                    $image->save(public_path().'/productImages/'.$uniqueImageName);
                    $productImage->image = $uniqueImageName;
                    $productImage->save();
                }
            }

            if ($request->hasFile('featureImage')) {
                $productImage = new ProductImages();
                $productImage->fkskuId = $sku->skuId;
                $productImage->fkProductId = $product->productId;
                $originalExtension = $request->featureImage->getClientOriginalExtension();
                $productImage->imageType = $originalExtension;
                $uniqueImageName = $sku->skuId.rand(100, 999).'.'.$originalExtension;
                $image = Image::make($request->featureImage);
                $image->save(public_path().'/productImages/'.$uniqueImageName);
                $productImage->image = $uniqueImageName;
                $productImage->save();
            }
        }

        Session::flash('success', 'Product Updated Successfully');

        return back();
    }

    //Variation Image Delete
    public function variationImageDelete($productImageId)
    {
        $productImage = ProductImages::where('product_imageId', $productImageId)->first();
        $productImage->delete();

        return back();
    }

    //Variation Status Change
    public function variationStatusChange(Request $request)
    {
        $sku = Sku::where('skuId', $request->skuId)->first();
        if ($sku->status == 'active') {
            $sku->status = 'inactive';
        } elseif ($sku->status == 'inactive') {
            $sku->status = 'active';
        }
        $sku->save();

        return response()->json(['status' => $sku->status, 'skuId' => $sku->skuId]);
    }

    //Delete Product
    public function delete(Request $request)
    {
        $product = Product::where('productId', $request->productId)->first();
        $file_path = public_path().'/productLogo/'.$product->productLogo;
        File::delete($file_path);
        $product->delete();

        return response()->json();
    }

    //Product Search
    public function productSearch(Request $data)
    {
        if (!empty($data->barCode)) {
            $productId = Sku::where('barcode', $data->barCode)->pluck('fkproductId')->first();
            if (!empty($productId)) {
                $productData = Product::with(['sku.variationRelation.variationDetailsdata'])
                                        ->where('status', 'active')
                                        ->findOrfail($productId);

                return response()->json(['product' => $productData]);
            } else {
                return response()->json(['message' => 'Product not found'], 406);
            }
        }
        if (!empty($data->category)) {
            $productData = Product::with(['sku.variationRelation.variationDetailsdata'])
                                    ->where(function ($query) use ($data) {
                                        return $query->where('categoryId', $data->category);
                                    })
                                    ->where('status', 'active')
                                    ->get();

            return response()->json(['product' => $productData]);
        } elseif (!empty($data->brand)) {
            $productData = Product::with(['sku.variationRelation.variationDetailsdata'])
                                    ->where(function ($query) use ($data) {
                                        return $query->where('fkbrandId', $data->brand);
                                    })
                                    ->where('status', 'active')
                                    ->get();

            return response()->json(['product' => $productData]);
        } else {
            $productData = Product::with('sku.variationRelation.variationDetailsdata')
                                    ->where(function ($query) use ($data) {
                                        return $query->where('productName', 'LIKE', '%'.$data->productIdOrName.'%')
                                                ->orWhere('productId', 'LIKE', '%'.$data->productIdOrName.'%')
                                                ->orWhere('productCode', 'LIKE', '%'.$data->productIdOrName.'%');
                                    })
                                    ->where('status', 'active')->get();

            // $product=$productData->map(function($item, $key){
            //                     $image = 'default.jpg';
            //                     $file = public_path('featureImage/'.$item->featureImage);
            //                     if(!file_exists($file) || empty($item->featureImage)){
            //                         $image='default.jpg';
            //                     }
            //                     return [
            //                         'images'=>$image
            //                         ]+$item->toArray();
            //                     });
            return response()->json(['product' => $productData]);
        }
    }
}
