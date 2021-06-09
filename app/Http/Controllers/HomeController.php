<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Testimonial;
use App\Models\Stock;
use App\Models\ShipmentZone;
use Illuminate\Support\Facades\DB;
use Darryldecode\Cart\Cart;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('homeShow', 1)->take(4)->get();
        $products = Product::with('category','sku')->where('status', 'active')->get();
        $sku = Sku::with('product')->where('status', 'active')->get();
        $newArrival =  Product::with('sku')->where('status', 'active')->where('newarrived', 1)->get();
        $recommendedProduct = Product::with('sku')->where('status', 'active')->where('isrecommended', 1)->get();
        $testimonials = Testimonial::where('status', 'active')->where('home',1)->get();
        return view('welcome',compact('categories','products','sku','newArrival','recommendedProduct','testimonials'));
    }

    public function productDetails($id){
        $productDetails = Product::with('sku','details','images')->findOrfail($id);  
        return view('productDetails',compact('productDetails'));
    }

    public function addToCart(Request $request){
        // dd($request->all());
        $stock=Stock::where('fkskuId',$request->_sku)->sum('stock');
        $quantity=$request->_quantity;
        
        if ($stock>=$quantity) {
            $productId =Sku::findOrfail($request->_sku,['fkproductId']);
            // dd($productId);
            $product=Product::with(['sku','images'])->where('status','active')->findOrFail($productId)->first();
            
            $batchToOrder = collect(DB::select(DB::raw("SELECT batchId, COALESCE(SUM(CASE WHEN stock_record.type = 'in' THEN stock END), 0) - COALESCE(SUM(CASE WHEN stock_record.type = 'out' THEN stock END), 0) as available
                            FROM stock_record
                            LEFT JOIN sku ON sku.skuId = stock_record.fkskuId
                            LEFT JOIN product ON sku.fkproductId = product.productId
                            WHERE fkskuId = $request->_sku
                            GROUP BY batchId ORDER BY available DESC")));
          
            $batch = $batchToOrder->pluck('batchId')->first();
            \Cart::add(array(
                'id' => $request->_sku,
                'name' => $product->productName,
                'price' => $product->sku()->where('skuId',$request->_sku)->first()->salePrice ?? '100',
                'quantity' =>$quantity ?? '1' ,
                'attributes' => array(
                    'batchId'=>$batch
                ),
                'associatedModel' => $product
            ));
    
            $cartPage= view('layouts.partials.cartNav')->render();
            $cartQuantity=\Cart::getContent()->count();
            // dd($cartQuantity);
            return response()->json(['cart'=>$cartPage,'cartQuantity'=>$cartQuantity],200);
        } else {
            return response()->json(['Quantity'=>'Out of Stock'],400);
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
        $shipmentZone=ShipmentZone::all();
        $cart=view('layouts.partials.cartNav',compact('shipmentZone'))->render();
        $cartQuantity=\Cart::getContent()->count();
      
        return response()->json(['cart'=>$cart,'cartQuantity'=>$cartQuantity],200);
    }

    public function cartIndex()
    {
        $shipmentZone=ShipmentZone::all();
        return view('cart',compact('shipmentZone'));
    }

    public function updateQuantity(Request $request){
        dd($request->all());
        $cart= \Cart::update($request->_sku, array(
            'quantity' => $request->value, 
        ));
        // dd($cart->quantity);
        $shipmentZone=ShipmentZone::all();
        $cart=view('cart',compact('shipmentZone'))->render();
        $cartQuantity=\Cart::getContent()->count();
        // dd($cart);
        return response()->json(['cart'=>$cart,'cartQuantity'=>$cartQuantity],200);
    }
}
