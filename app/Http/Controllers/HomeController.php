<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Sku;
use App\Models\Testimonial;
use App\Models\Stock;
use App\Models\ShipmentZone;
use App\Models\ProductMostViewed;
use Illuminate\Support\Facades\DB;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;
// use DB;
use Session;

class HomeController extends Controller
{
    public function index(){
        $dateToday = date('Y-m-d h:i:s');
        $sliders = Slider::where('status', 'active')->get();
        $banners = Banner::where('status', 'active')->with('promotion')->take(2)->get();
        // $validPromotion = Promotion::where('promotionsId',$ba)
        // dd($banners->promotion);
        // dd($banners);
        // // foreach($banners as $item){
        // //     $validPromotion = $item->promotion->where('startDate', '<=', date('Y-m-d H:i:s'))->where('endDate', '>=', date('Y-m-d H:i:s'))->get();

        // // }

        $categories = Category::where('homeShow', 1)->with('products.sku','products.hotdealProducts.hotdeals')->get();
        $products = Product::with('category','sku')->where('status', 'active')->get();

        $skus = Sku::with('product')->whereHas('product', function ($query) {
            $query->where('status', 'active');
        })->take(15)->get();

        $newArrivals = Sku::with('product')->whereHas('product', function ($query) {
            $query->where('status', 'active')->where('newarrived', 1);
        })->take(15)->get();
        // dd($newArrivalSkus);

        $recommendeds =  $newArrivalSkus = Sku::with('product')->whereHas('product', function ($query) {
            $query->where('status', 'active')->where('isrecommended', 1);
        })->take(15)->get();
        $testimonials = Testimonial::where('status', 'active')->where('home',1)->get();
        
        if(Auth::check()){
            $mostViewedProducts = ProductMostViewed::where('fkuserId', Auth::user()->userId)->get();
        }else{
            $mostViewedProducts = ProductMostViewed::where('session_id', \Request::ip())->get();
        }
        
       

        return view('welcome',compact('categories', 'products', 'skus', 'newArrivals', 'recommendeds', 'testimonials', 'sliders', 'banners', 'mostViewedProducts'));
    }


    public function offers(){
        $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first();
        $oldprice = null;
        if(empty($hotDeal)){
            $saleprice = $sku->salePrice ;
        }

        if(!empty($hotDeal)) {
             $percentage = $hotDeal->hotdeals->percentage;
             $afterDiscountPrice = ($sku->salePrice) - (($sku->salePrice) * $percentage) / 100;

            $saleprice = $afterDiscountPrice;
            $oldprice = $sku->salePrice;
         }
         dd($hotDeal);
        return view('offers');
    }


    public function quickView(Request $request){
        $sku_id = $request->sku_id;
        $sku = Sku::with('product', 'product.details')->where('skuId', $sku_id)->first();
        $reviews = Review::where('fkproductId', $sku->fkproductId)->get();
        $revCount = $reviews->count();
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
        $images = $sku->product->images()->get();

        $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first();
        $oldprice = null;
        if(empty($hotDeal)){
            $saleprice = $sku->salePrice ;
        }

        if(!empty($hotDeal)) {
             $percentage = $hotDeal->hotdeals->percentage;
             $afterDiscountPrice = ($sku->salePrice) - (($sku->salePrice) * $percentage) / 100;

            $saleprice = $afterDiscountPrice;
            $oldprice = $sku->salePrice;
         }

        return response()->json(['sku'=>$sku, 'hotdeal'=>$hotDeal, 'saleprice'=>$saleprice, 'finalRating'=>$finalRating, 'reviews'=>$reviews, 'revCount'=>$revCount, 'oldprice'=>$oldprice, 'images'=>$images]);
    }

    public function addToCart(Request $request){
     
        $stockIn=Stock::where('fkskuId',$request->_sku)->where('type', 'in')->sum('stock');
        $stockOut=Stock::where('fkskuId',$request->_sku)->where('type', 'out')->sum('stock');
        $stockAvailable = $stockIn-$stockOut;
        $quantity=$request->_quantity;



        if ($stockAvailable >= $quantity) {
            $sku =Sku::findOrfail($request->_sku);
//            $product=Product::with(['sku','images'])->where('status','active')->findOrFail($productId)->first();
            $product=$sku->product()->first();
            $productImage=$sku->variationImages()->first();
            $batchToOrder = collect(DB::select(DB::raw("SELECT batchId, COALESCE(SUM(CASE WHEN stock_record.type = 'in' THEN stock END), 0) - COALESCE(SUM(CASE WHEN stock_record.type = 'out' THEN stock END), 0) as available
                            FROM stock_record
                            LEFT JOIN sku ON sku.skuId = stock_record.fkskuId
                            LEFT JOIN product ON sku.fkproductId = product.productId
                            WHERE fkskuId = $request->_sku
                            GROUP BY batchId ORDER BY available DESC")));

            $batch = $batchToOrder->pluck('batchId')->first();
            $variations=[];
            foreach($sku->variationRelation as $variation){
                array_push($variations,$variation->variationDetailsdata);
            }

            $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first();

            $afterDiscountPrice = null;
            if(!empty($hotDeal)){
                $percentage = $hotDeal->hotdeals->percentage;
                $afterDiscountPrice = ($sku->salePrice) - (($sku->salePrice)*$percentage)/100;
            }

            \Cart::add(array(
                'id' => $sku->skuId,
                'name' => $sku->product->productName,
                'price' => $afterDiscountPrice ? $afterDiscountPrice : $sku->salePrice ?? '0',
                'quantity' =>$quantity,
                'attributes' => array(
                    'batchId'=>$batch,
                    'variations' => $variations
                ),
                'associatedModel' => $product, $productImage
            ));
//            dd(\Cart::getContent());
            $cartPage= view('layouts.partials.cartNav')->render();
            $cartQuantity=\Cart::getContent()->count();
            return response()->json(['cart'=>$cartPage,'cartQuantity'=>$cartQuantity],200);
        } else {
            return response()->json(['Quantity'=>'Stock not available'],400);
        }

    }

    public function updateQuantity(Request $request){
        $stockIn=Stock::where('fkskuId',$request->_sku)->where('type', 'in')->sum('stock');
        $stockOut=Stock::where('fkskuId',$request->_sku)->where('type', 'out')->sum('stock');
        $stockAvailable = $stockIn-$stockOut;
        $quantity=$request->_quantity;

        if ($stockAvailable >= $quantity) {
            \Cart::update($request->_sku,[
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->_quantity,
                )
            ]);
            $cartPage= view('layouts.partials.cartNav')->render();
            $cartQuantity=\Cart::getContent()->count();
            return response()->json(['cart'=>$cartPage,'cartQuantity'=>$cartQuantity],200);
        } else {
            return response()->json(['Quantity'=>'Stock not available'],400);
        }
    }


    public function removeItem(Request $request){

        \Cart::remove($request->_sku);
        $condition=\Cart::getCondition('coupon');
        if(!empty($condition)){
            $conditionSku=$condition->getAttributes();
            if ($conditionSku['sku'] == $request->_sku) {
                \Cart::clearCartConditions();
            }
        }
        if (\Cart::isEmpty()) {
            \Cart::clear();
            \Cart::clearCartConditions();
        }
        $cart=view('layouts.partials.cartNav')->render();
        $cartQuantity=\Cart::getContent()->count();

        return response()->json(['cart'=>$cart,'cartQuantity'=>$cartQuantity],200);
    }

    public function cartIndex()
    {
        $shipmentZone=ShipmentZone::all();

        if(Auth::check()){
            $userId = Auth::user()->userId;
            $customer = Customer::where('fkuserId',$userId)->first();

            return view('cart',compact('shipmentZone','customer'));
        }

       return view('cart',compact('shipmentZone'));
    }

}
