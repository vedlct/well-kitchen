<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Testimonial;
use App\Models\Stock;
use App\Models\ShipmentZone;
use Illuminate\Support\Facades\DB;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::where('status', 'active')->get();
        $categories = Category::where('homeShow', 1)->take(4)->get();
        $products = Product::with('category','sku')->where('status', 'active')->get();
        $skus = Sku::with('product')->where('status', 'active')->get();

        $newArrival =  Product::with('sku')->where('status', 'active')->where('newarrived', 1)->get();
        $recommendedProduct = Product::with('sku')->where('status', 'active')->where('isrecommended', 1)->get();
        $testimonials = Testimonial::where('status', 'active')->where('home',1)->get();
        return view('welcome',compact('categories','products','skus','newArrival','recommendedProduct','testimonials','sliders'));
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
