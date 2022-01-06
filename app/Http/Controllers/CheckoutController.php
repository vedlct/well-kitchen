<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipmentZone;
use App\Models\User;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Charges;
use App\Models\Order;
use App\Models\OrderStatusLog;
use App\Models\OrderProduct;
use App\Models\StockRecord;
use App\Models\Batch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $shipmentZone = ShipmentZone::where('status', 'active')->get();
        // dd($shipmentZone);
        if (Auth::check()) {
            $customer = Customer::where('fkuserId', Auth::user()->userId)->with('address', 'order', 'user')->first();
            return view('checkout', compact('customer', 'shipmentZone'));
        }

        return view('checkout', compact('shipmentZone'));
    }

    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
        $result = Customer::where('phone', 'LIKE', '%' . $search . '%')->get();
        return response()->json($result);
    }


    public function searchUserByPhone(Request $request)
    {
        $phone = $request->phone;
        $customer = Customer::where('phone', $phone)->first();
        if ($customer != null) {
            $user = $customer->user()->first();
            $shippingAddress = $customer->address()->orderBy('addressId', 'DESC')->first();
            return response()->json(['user' => $user, 'customer' => $customer, 'shippingAddress' => $shippingAddress]);
        }

        return response()->json(['customer' => $customer]);
    }

    public function shippingZone(Request $request)
    {
        $deliveryFee = Charges::where('fkshipment_zoneId', $request->shipping_zone)->pluck('deliveryFee')->first();
        if (!empty(Session::get('sub'))) {

            if (!empty(Session::get('catUpdate'))) {

                $orderTotal = round((\Cart::getSubTotal() + $deliveryFee) - number_format(Session::get('discountAmount')));
            } else {
                $orderTotal = number_format(Session::get('sub') + $deliveryFee);
                //            Session::forget('shipTotal');
                //
                //            Session::put('shipTotal', $orderTotal);
                //            $orderTotal = Session::get('shipTotal');
            }
        }

        if (empty(Session::get('sub'))) {
            $orderTotal = number_format(\Cart::getSubTotal() + $deliveryFee);
        }


        return response()->json(['deliveryFee' => $deliveryFee, 'orderTotal' => $orderTotal]);
    }


    public function checkoutSubmit(Request $request)
    {
        // dd(\Cart::getContent()->count());

        $validated = $request->validate([
            'first_name' => 'required|max:50',
            //            'email' => 'required',
            'phone' => 'required',
            'billingAddress' => 'required',
            'fkshipment_zoneId' => 'required',
            'payment' => 'required',
        ]);

        if (!Auth::user()) {
            $customer = Customer::where('phone', $request->phone)->first();
        }
        if (Auth::user()) {
            $customer = Customer::where('fkuserId', Auth::user()->userId)->first();
        }

        // dd($customer);


        if (!Auth::user() && empty($customer)) {
            $guestUser =  new User();
            $guestUser->firstName = $request->first_name;
            $guestUser->lastName = $request->last_name;
            $guestUser->email = $request->email;
            // $guestUser->password = Hash::make('123456');
            $guestUser->password = bcrypt($request->password);
            $guestUser->fkuserTypeId = 2;
            $guestUser->save();

            $customer = new Customer();
            $customer->fkuserId = $guestUser->userId;
            $customer->phone = $request->phone;
            $customer->status = 'active';
            $customer->save();

            $address = new Address();
            $address->billingAddress = $request->billingAddress;
            if ($request->shipping == 'on') {
                $address->shippingAddress = $request->diffshippingAddress;
            } else {

                $address->shippingAddress = $request->billingAddress;
            }
            $address->fkcustomerId  = $customer->customerId;
            $address->fkshipment_zoneId  = $request->fkshipment_zoneId;
            $address->save();
        }
        if (Auth::user() && !empty($customer)) {
            $address = Address::where('fkcustomerId', $customer->customerId)->first();

            if (empty($address)) {
                $address = new Address();
                $address->billingAddress = $request->billingAddress;

                if ($request->shipping == 'on') {
                    $address->shippingAddress = $request->diffshippingAddress;
                } else {
                    $address->shippingAddress = $request->billingAddress;
                }
                $address->fkcustomerId  = $customer->customerId;
                $address->fkshipment_zoneId  = $request->fkshipment_zoneId;
                $address->save();
            }
        }


        $deliveryFee = 0;
        $deliveryFee += Charges::where('fkshipment_zoneId', $request->fkshipment_zoneId)->pluck('deliveryFee')->first();
        // dd($customer);
        if (\Cart::getContent()->count() > 0) {
            $order = new Order();
            $order->fkcustomerId = $customer ? $customer->customerId : '';
            $order->note = $request->message;
            $order->deliveryFee = $deliveryFee;
            if (Session::has('discountAmount')) {
                $order->discount = Session::get('discountAmount');
            }
            if (Session::has('sub')) {
                // $order->orderTotal = Session::get('sub') + $deliveryFee;
                $order->orderTotal = Session::get('sub');
            }
            if (Session::has('promoId')) {
                // $order->orderTotal = Session::get('sub') + $deliveryFee;
                $order->promoId = Session::get('promoId');
            }
            if (!Session::has('sub')) {
                // $order->orderTotal = \Cart::getSubTotal() + $deliveryFee;
                $order->orderTotal = \Cart::getSubTotal();
            }
            // $order->paymentType = 'cod';
            $order->payment_status = 'unpaid';
            $order->payment_type = $request->payment;
            // $order->delivery_commission_type = 'taka';
            $order->save();


            $order_status_log = new OrderStatusLog();
            $order_status_log->order_id = $order->orderId;
            $order_status_log->status = 1;
            $order_status_log->note = $order->note;
            $order_status_log->save();

            foreach (\Cart::getContent() as $cartData) {
                // @dd($cartData);
                $q = $cartData['quantity'];
                // dd($q);
                $order_item = new OrderProduct();
                $order_item->fkorderId = $order->orderId;
                $order_item->quiantity = $cartData->quantity;
                $order_item->price = $cartData->price;
                $order_item->total = $cartData->price * $cartData->quantity;
                $order_item->fkskuId = $cartData->id;
                $order_item->batch_id = $cartData->attributes->batchId ?? '0';
                $order_item->save();

                $batches = StockRecord::where('fkskuId', $cartData->id)->pluck('batchId')->unique();
                // dd($batches);
                $stockAvailable = [];
                foreach ($batches as $batchId) {
                    $inStock = StockRecord::where('batchId', $batchId)->where('type', 'in')->sum('stock');
                    $outStock = StockRecord::where('batchId', $batchId)->where('type', 'out')->sum('stock');
                    $stockAvailable[$batchId] = $inStock - $outStock;
                }

                $maxStock = max($stockAvailable);
                $check = $maxStock - $q;
                if ($q > $maxStock) {
                    $q = $maxStock;
                }

                $batchId = array_keys($stockAvailable, $maxStock);

                $batch = Batch::where('batchId', $batchId)->pluck('batchId')->first();
                $price = Batch::where('batchId', $batchId)->pluck('salePrice')->first();
                // $order_item->price = $price;
                // $order_item->total = $q * $price;
                
            

                $stock_record = new StockRecord();
                $stock_record->batchId = $cartData->attributes->batchId ?? '0';
                $stock_record->fkskuId = $cartData->id;
                $stock_record->order_id = $order->orderId;
                $stock_record->stock = $q;
                $stock_record->type = 'out';
                $stock_record->identifier = 'sale';
                $stock_record->save();

                if ($check <= 0) {
                    $quantity = abs($check);
                    $sku = $cartData->id;
                    $order = $order->orderId;
                    $this->OrderStock($quantity, $sku, $order, $order_item, $cartData);
                }
            }

            \Cart::clear();
        }
        Session::flash('success', 'Order placed successfully');
        if (Session::has('discountAmount')) {
            Session::forget('discountAmount');
        }
        if (Session::has('sub')) {
            Session::forget('sub');
        }
        //        Session::flash('success', 'Order placed successfully');

        return redirect('/');
    }

    public function OrderStock($quantity, $sku, $order, $order_item, $cartData)
    {
        $batches = StockRecord::where('fkskuId', $sku)->pluck('batchId')->unique();
        $stockAvailable = [];
        foreach ($batches as $batchId) {
            $inStock = StockRecord::where('batchId', $batchId)->where('type', 'in')->sum('stock');
            $outStock = StockRecord::where('batchId', $batchId)->where('type', 'out')->sum('stock');
            $stockAvailable[$batchId] = $inStock - $outStock;
        }

        $maxStock = max($stockAvailable);

        $check = $maxStock - $quantity;
        if ($quantity > $maxStock) {
            $quantity = $maxStock;
        }

        $batchId = array_keys($stockAvailable, $maxStock);
        $batch = Batch::where('batchId', $batchId)->pluck('batchId')->first();
        $price = Batch::where('batchId', $batchId)->pluck('salePrice')->first();

        $order_item->price = $price;
        $order_item->total = $quantity * $price;
        $order_item->batch_id = $cartData->attributes->batchId ?? '0';
        $order_item->save();

        $stock_record = new StockRecord();
        $stock_record->batchId = $cartData->attributes->batchId ?? '0';
        $stock_record->fkskuId = $sku;
        $stock_record->order_id = $order;
        $stock_record->stock = $quantity;
        $stock_record->type = 'out';
        $stock_record->identifier = 'sale';
        $stock_record->save();

        if ($check <= 0) {
            $quantity = abs($check);
            $sku = $sku;
            $order = $order;
            return $this->OrderStock($quantity, $sku, $order, $order_item, $cartData);
        }
        return redirect()->route('home');
    }
}
