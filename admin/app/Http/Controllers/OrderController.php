<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Sku;
use App\Models\Batch;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Category;
use App\Models\Settings;
use App\Models\Transaction;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use App\Models\ShipmentZone;
use Illuminate\Http\Request;
use App\Models\OrderStatusLog;
use App\Models\DeliveryBalance;
use App\Models\DeliveryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function add()
    {
        $zones = ShipmentZone::with('charges')->get();
        $deliveryServices = DeliveryService::all();
        $category = Category::all();
        $brand = Brand::all();

        return view('order.add', compact('zones', 'deliveryServices', 'category', 'brand'));
    }

    public function batchToselect(Request $r)
    {
        $batchToOrder = collect(DB::select(DB::raw("SELECT batchId,sku.salePrice, COALESCE(SUM(CASE WHEN type = 'in' THEN stock END), 0) - COALESCE(SUM(CASE WHEN type = 'out' THEN stock END), 0) as available
                                                FROM stock_record LEFT JOIN sku ON sku.skuId = stock_record.fkskuId
                                                WHERE fkskuId = $r->sku
                                                GROUP BY batchId ORDER BY available DESC")));
        $batch = $batchToOrder->first();

        return response()->json($batch, 200);
    }

    public function addToOrder(Request $r)
    {
        $batchFind = Batch::where('skuId', $r->sku)->get();
        if (count($batchFind) > 0) {
            $batchToOrder = collect(DB::select(DB::raw("SELECT batchId,sku.salePrice,product.productName, COALESCE(SUM(CASE WHEN stock_record.type = 'in' THEN stock END), 0) - COALESCE(SUM(CASE WHEN stock_record.type = 'out' THEN stock END), 0) as available
                                                    FROM stock_record
                                                    LEFT JOIN sku ON sku.skuId = stock_record.fkskuId
                                                    LEFT JOIN product ON sku.fkproductId = product.productId
                                                    WHERE fkskuId = $r->sku
                                                    GROUP BY batchId ORDER BY available DESC")));

            $batch = $batchToOrder->first();

            if ($batch->available > 0) {
                if (!session()->exists('cartSessionKey')) {
                    session(['cartSessionKey' => Str::random(40)]);
                }
                $cart = \Cart::add([
                'id' => $r->sku,
                'name' => $r->product ?? 'null',
                'price' => $batch->salePrice ?? 100,
                'quantity' => 1,
                'attributes' => [
                    'maxAmount' => $batch->available,
                    'skuid' => $r->sku,
                    'batchId' => $batch->batchId,
                    'discount' => 0,
                    'subTotal' => $batch->salePrice * 1,
                ],
            ]);
                $cart = view('order.orderProduct')->render();
                $total = \Cart::getTotal();

                return response()->json(['total' => $total, 'cart' => $cart]);
            } else {
                return response()->json('not availble', '404');
            }
        } else {
            return response()->json(['message' => 'Product purchase is not done yet'], 406);
        }
    }

    public function removeItem(Request $r)
    {
        if (!empty($r->rowId)) {
            \Cart::remove($r->rowId);
            $total = $this->cartTotal();
            $cart = view('order.orderProduct')->render();

            return response()->json(['total' => $total, 'cart' => $cart]);
        } else {
            \Cart::clear();
            $total = $this->cartTotal();
            $cart = view('order.orderProduct')->render();

            return response()->json(['total' => $total, 'cart' => $cart]);
        }
    }

    public function editItem(Request $request)
    {
        dd($request->all());
        $orderItem = OrderProduct::where('order_itemId', $request->rowId)->first();

//        if (!empty($r->rowId)) {
//            \Cart::remove($r->rowId);
//            $total = $this->cartTotal();
//            $cart = view('order.orderProduct')->render();
//
//            return response()->json(['total' => $total, 'cart' => $cart]);
//        } else {
//            \Cart::clear();
//            $total = $this->cartTotal();
//            $cart = view('order.orderProduct')->render();
//
//            return response()->json(['total' => $total, 'cart' => $cart]);
//        }
    }


    public function updateQuantity(Request $r)
    {
        if ($r->type == 'inc') {
            $maxQuantity = \Cart::get($r->id)->attributes->maxAmount;
            if (\Cart::get($r->id)->quantity > $maxQuantity) {
                $total = $this->cartTotal();
                $cart = view('order.orderProduct')->render();
                $all = \Cart::getContent();

                return response()->json(['total' => $total, 'cart' => $cart, 'notAvailable' => true, 'all' => $all]);
            } else {
                \Cart::clearItemConditions($r->id);
                $cart = \Cart::update($r->id, [
                    'quantity' => 1,
                ]);
            }
        } else {
            \Cart::clearItemConditions($r->id);
            $cart = \Cart::update($r->id, [
                'quantity' => -1,
              ]);
        }

        $total = $this->cartTotal();
        $cart = view('order.orderProduct')->render();
        $all = \Cart::getContent();

        return response()->json(['total' => $total, 'cart' => $cart, 'all' => $all]);
    }

    public function discount(Request $r)
    {
        // \Cart::update($r->id, [
        //     'attributes' => [
        //         'discount' =>  $r->discount
        //     ]

        // ]);
        \Cart::get($r->id)->attributes->discount = $r->discount;
        $total = $this->cartTotal();
        $cart = view('order.orderProduct')->render();
        $all = \Cart::getContent();

        return response()->json(['total' => $total, 'cart' => $cart, 'all' => $all]);
    }

    public function cartTotal()
    {
        $total = 0;
        foreach (\Cart::getContent() as $row) {
            $subtotal = $row->quantity * $row->price - \Cart::get($row->id)->attributes->discount;
            $total = $total + $subtotal;
        }

        return $total;
    }

    public function orderInsert(Request $request)
    {
        // return $r;
        $this->validate($request, [
            // 'billingAddress' => 'required',
//            'customer' => 'required',
//            'delivery_charge' => 'required',
//            'delivery_company' => 'required',
//            'delivery_date' => 'required',
//            'delivery_location' => 'required',
//            'due_amount' => 'nullable|numeric',
//            'paid_amount' => 'nullable|numeric',
//            'payment_method' => 'nullable',
//            'payment_type' => 'nullable',
//            'shipping_address' => 'required',
//            'saleLocation' => 'required',
        ]);

        $order = new Order();
        $order->fkcustomerId = $request->customerId;
        $order->sale_type = $request->saleType ?? 'online';
        $order->delivery_service = $request->delivery_company;
        $order->deliveryTime = $request->delivery_date;
        $order->deliveryFee = $request->delivery_charge;
        $order->orderTotal = $this->cartTotal();
        $order->sale_type = $request->saleType ?? 'shop';
        $order->print = '1';
        $order->note = $request->orderNote ?? null;
        if (floatval($request->paid_amount) == $this->cartTotal()) {
            $order->payment_status = 'paid';
        } elseif (floatval($request->paid_amount) > 0) {
            $order->payment_status = 'partial';
        } else {
            $order->payment_status = 'unpaid';
        }
        if (!empty($request->saleType) && $request->saleType == 'online') {
            $order->last_status = 'Created';
        } else {
            $order->last_status = 'Delivered';
        }
        $order->save();

        foreach (\Cart::getContent() as $key => $product) {
            $orderedProduct = new OrderProduct();
            $orderedProduct->fkorderId = $order->orderId;
            $orderedProduct->fkskuId = $product->attributes->skuid;
            $orderedProduct->batch_id = $product->attributes->batchId;
            $orderedProduct->price = $product->price;
            $orderedProduct->quiantity = $product->quantity;
            $orderedProduct->total = $product->quantity * $product->price - $product->attributes->discount ?? '0';
            $orderedProduct->discount = $product->attributes->discount ?? '0';
            $orderedProduct->save();

            $stockRecordChange = new Stock();
            $stockRecordChange->fkskuId = $product->attributes->skuid;
            $stockRecordChange->batchId = $product->attributes->batchId;
            $stockRecordChange->order_id = $order->orderId;
            $stockRecordChange->stock = $product->quantity;
            $stockRecordChange->type = 'out';
            $stockRecordChange->identifier = 'sale';
            $stockRecordChange->save();
        }

        $orderStatus = new OrderStatusLog();
        $orderStatus->order_id = $order->orderId;
        $orderStatus->addedBy = Auth::user()->userId ?? '1';
        if (!empty($request->saleType) && $request->saleType == 'online') {
            $orderStatus->status = 'Created';
        } else {
            $orderStatus->status = 'Delivered';
        }
        $orderStatus->note = $request->orderNote ?? null;
        $orderStatus->save();

        if (!empty($request->paid_amount)) {
            /* passing the orderdata to Transaction controller @orderTransaction(#data) method
             * @param array contains instance of Request instance
             * @param array inject $paid amount  to the Request instance
             * @return boolean (true) ? "success" : "failed"
            **/
            $request['orderId'] = $order->orderId;
            TransactionController::orderTransaction($request);
        }
        /* passing the orderdata to Membership and Transaction controller if user is a member and also reedm point during order
         * @param array contains instance of Request instance
         * @param array inject {$paid_amount,payment_type,payment_method}  to the Request instance
         * @return boolean (true) ? "success" : "failed"
         **/
        if (!empty($request->point)) {
            $order->orderTotal = $this->cartTotal() - intval($request->point);
            $orderData = [];
            $orderData['customerId'] = $request->customerId;
            $orderData['orderTotal'] = $this->cartTotal();
            $orderData['orderId'] = $order->orderId;
            $orderData['type'] = 'out';
            $orderData['point'] = $request->point;
            $request['orderId'] = $order->orderId;
            $request['paid_amount'] = $request->point;
            $request['payment_type'] = 'redeem';
            $request['payment_method'] = 'redeem';
            MembershipController::addPointToMemeber($orderData);
            TransactionController::orderTransaction($request);
        } else {
            $order->orderTotal = $this->cartTotal();
        }
        /*passing the orderdata to Membership controller if user is a member and also add point against him/her during order
        * @param array contains instance of @Orderdata instance
        * @param array inject {$customerId,orderTotal,orderId}  to the Request instance
        * @return boolean (true) ? "success" : "failed"
        **/
        if (!empty($request->customerId)) {
            $orderData = [];
            $orderData['customerId'] = $request->customerId;
            $orderData['orderTotal'] = $this->cartTotal();
            $orderData['orderId'] = $order->orderId;
            MembershipController::addPointToMemeber($orderData);
        }

        \Cart::clear();

        return [$order];
    }

    public function index()
    {
        return view('order.index');
    }

    public function list(Request $request)
    {
        $order = Order::select('order_info.orderId', 'order_info.last_status', 'customer.phone', 'orderTotal', 'order_info.created_at', 'order_info.updated_at', 'order_info.print')
       ->leftjoin('customer', 'customerId', 'fkcustomerId')->orderBy('order_info.orderId', 'DESC');

        if (!empty($request->fromDate) && empty($request->toDate) && empty($request->orderStatus)) {
            $order = $order->whereDate('order_info.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate) && empty($request->orderStatus)) {
            $order = $order->whereDate('order_info.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate) && empty($request->orderStatus)) {
            $order = $order->where('order_info.created_at', '>=', $request->fromDate.' 12:00:00')
                ->where('order_info.created_at', '<=', $request->toDate.' 23:59:59');
        }

        if (empty($request->fromDate) && empty($request->toDate) && !empty($request->orderStatus)) {
            $order = $order->where('order_info.last_status', $request->orderStatus);
        }

        if (!empty($request->fromDate) && empty($request->toDate) && !empty($request->orderStatus)) {
            $order = $order->where('order_info.last_status', $request->orderStatus)->whereDate('order_info.created_at', $request->fromDate);
        }

        if (empty($request->fromDate) && !empty($request->toDate) && !empty($request->orderStatus)) {
            $order = $order->where('order_info.last_status', $request->orderStatus)->whereDate('order_info.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate) && !empty($request->orderStatus)) {
            $order = $order->where('order_info.created_at', '>=', $request->fromDate.' 12:00:00')
                ->where('order_info.created_at', '<=', $request->toDate.' 23:59:59')
                ->where('order_info.last_status', $request->orderStatus);
        }

        //return response()->json($order);
        return Datatables::of($order)
            ->addColumn('totalpaid', function ($totalpaid) {
                $totalpaid = Transaction::where('fkorderId', '=', $totalpaid->orderId)->sum('amount');

                return $totalpaid;
            })
            ->addColumn('remark', function ($remark) {
                $orderlog = OrderStatusLog::where('order_id', $remark->orderId)->latest('status_log_id')->first()->note ?? 'null';

                return $orderlog;
            })
//            ->addColumn('Status', function ($status) {
//                $Status = OrderStatusLog::where('order_id', $status->orderId)->latest('status_log_id')->first()->status ?? 'null';
//                return $Status;
//            })
            ->make(true);
    }

    public function orderEdit($id){
        $order = Order::with('orderedProduct')->where('orderId', $id)->first();
        return view('order.edit', compact('order'));

//        $order = new Order();
//        $order->fkcustomerId = $request->customerId;
//        $order->sale_type = $request->saleType ?? 'online';
//        $order->delivery_service = $request->delivery_company;
//        $order->deliveryTime = $request->delivery_date;
//        $order->deliveryFee = $request->delivery_charge;
//        $order->orderTotal = $this->cartTotal();
//        $order->sale_type = $request->saleType ?? 'shop';
//        $order->print = '1';
//        $order->note = $request->orderNote ?? null;
//        if (floatval($request->paid_amount) == $this->cartTotal()) {
//            $order->payment_status = 'paid';
//        } elseif (floatval($request->paid_amount) > 0) {
//            $order->payment_status = 'partial';
//        } else {
//            $order->payment_status = 'unpaid';
//        }
//        if (!empty($request->saleType) && $request->saleType == 'online') {
//            $order->last_status = 'Created';
//        } else {
//            $order->last_status = 'Delivered';
//        }
//        $order->save();
//
//        foreach (\Cart::getContent() as $key => $product) {
//            $orderedProduct = new OrderProduct();
//            $orderedProduct->fkorderId = $order->orderId;
//            $orderedProduct->fkskuId = $product->attributes->skuid;
//            $orderedProduct->batch_id = $product->attributes->batchId;
//            $orderedProduct->price = $product->price;
//            $orderedProduct->quiantity = $product->quantity;
//            $orderedProduct->total = $product->quantity * $product->price - $product->attributes->discount ?? '0';
//            $orderedProduct->discount = $product->attributes->discount ?? '0';
//            $orderedProduct->save();
//
//            $stockRecordChange = new Stock();
//            $stockRecordChange->fkskuId = $product->attributes->skuid;
//            $stockRecordChange->batchId = $product->attributes->batchId;
//            $stockRecordChange->order_id = $order->orderId;
//            $stockRecordChange->stock = $product->quantity;
//            $stockRecordChange->type = 'out';
//            $stockRecordChange->identifier = 'sale';
//            $stockRecordChange->save();
//        }


    }

    public function details(Request $request, $id)
    {
        $order = Order::with('customer.user', 'orderedProduct.sku.product', 'orderStatusLogs.author', 'transaction', 'delivery', 'lastStatus')->find($id);
        // return $order->paidAmount();
        // dd($order);
        return view('order.show', compact('order'));
    }

    public function orderStatus(Request $request)
    {
        // return $request;
        $order = Order::with('customer.user', 'orderedProduct.sku.product', 'orderStatusLogs.author', 'transaction', 'delivery', 'lastStatus')->find($request->id);
        $deliveryServices = DeliveryService::all();
        $orderPaidAmount = Transaction::where([['fkorderId', $order->orderId], ['payment_type', '!=', 'return']])->sum('amount');
        $dueAmount = $order->orderTotal - $orderPaidAmount;
        $modal = view('order.orderStatusModal', compact('order', 'deliveryServices', 'dueAmount'))->render();

        return response()->json($modal);
    }

    public function orderStatusChange(Request $request)
    {
        // $this->validate($request, [
        //     'status' => 'required',
        // ]);
        if ($request->status == 'Created' && $request->currentStatus !== 'Return') {
            abort(422, 'To make a order Created current status must be Cancel state.');
        }

        // Complete and delivered order status change
        if (Str::contains($request->status, ['Delivered', 'Complete']) === true) {
            if ($request->currentStatus !== 'Return' && $request->currentStatus !== 'Cancel') {
                $orderInfo = Order::find($request->orderId);
                $orderPaidAmount = Transaction::where([['fkorderId', $request->orderId], ['payment_type', '!=', 'return']])->sum('amount');
                $orderDue = $orderInfo->orderTotal - $orderPaidAmount;
                if ($orderDue > 0) {
                    /* passing the orderdata to Transaction controller @orderTransaction(#data) method
                     * @param array contains instance of Request instance
                     * @param array inject $paid amount  to the Request instance
                     * @return boolean (true) ? "success" : "failed"
                    **/
                    $request['paid_amount'] = $orderDue;
                    TransactionController::orderTransaction($request);
                }
                if ($orderInfo->sale_type == 'Online') {
                    /**
                     * Passing the data to add balance to delivery service.
                     *
                     * @deliveryBalanceAdd(#data) add new blanace to delivery balance
                     * @deliveryBalanceAdd(#data) add new transaction with payment type "Delivery"
                     * returns boolean. (true) ? success : failed
                     **/
                    $deliveryAdded = $this->deliveryBalanceAdd($request);
                    /*
                     * if the @deliveryAdd() return true then change the order status
                     * @orderStatusUpdate(#data) return also blooen. (true) ? success : failed
                     **/
                    if ($deliveryAdded === true) {
                        $request['payment_status'] = 'paid';
                        $this->orderStatusUpdate($request);
                    } else {
                        return $deliveryAdded;
                    }
                } else {
                    $request['payment_status'] = 'paid';
                    $this->orderStatusUpdate($request);
                }
            } else {
                abort(422, 'To make a order Delivered current status may not in Return state.');
            }
        }

        // OnDelivery order status change
        if (Str::contains($request->status, 'OnDelivery') === true) {
            if ($request->currentStatus !== 'Return' && $request->currentStatus !== 'Cancel' && $request->currentStatus !== 'Delivered' && $request->currentStatus !== 'Complete') {
                if (!empty($request->collectAmount)) {
                    $orderInfo = Order::find($request->orderId);
                    $orderPaidAmount = Transaction::where([['fkorderId', $request->orderId], ['payment_type', '!=', 'return']])->sum('amount');
                    $orderDue = $orderInfo->orderTotal - floatval($request->collectAmount);

                    /*
                        *passing the orderdata to Transaction controller @orderTransaction(#data) method
                        * @param array contains instance of Request instance
                        * @param array inject $paid amount  to the Request instance
                        * @return boolean (true) ? "success" : "failed"
                    **/
                    $request['paid_amount'] = $request->collectAmount;
                    TransactionController::orderTransaction($request);

                    $request['payment_status'] = $orderDue > 0 ? 'partial' : 'paid';
                    $this->orderStatusUpdate($request);
                }
            } else {
                abort(422, "To make a order OnDelivery current status cant be on $request->currentStatus state.");
            }
        }

        // Return order status change
        if (Str::contains($request->status, 'Return') === true) {
            if (Str::contains($request->currentStatus, ['OnDelivery', 'Delivered']) === false) {
                abort(422, 'To make a order Returned current status must be OnDelivery or Delivered state.');
            }

            $orderInfo = Order::with('transaction', 'customer')->find($request->orderId);
            $orderedProduct = OrderProduct::where('fkorderId', $request->orderId)->get();

            /*
                * Checking the order has mutiple product if it has then looping them
                *In each iteration it will call the @returnOrder(#sku) function
            */
            foreach ($orderedProduct as $product) {
                $skuInfo = [
                    'orderItemId' => $product->order_itemId,
                    'previousQuantity' => $product->quiantity,
                    'returnQuantity' => $product->quiantity,
                    'reason' => null,
                ];
                $return = $this->returnOrder($skuInfo);
            }

            /*
                * Checking the order return was succesfull or not
                * if the return is successfull then it will call @orderStatusUpdate(#data)
                * then the order will be saved with new status
            */
            if ($return === true) {
                $this->orderStatusUpdate($request);
            } else {
                abort(422, 'Oh my God!!\r\n The system is facing new problem!');
            }
        }

        $this->orderStatusUpdate($request);
    }

    /**
     * Change the status an order to new State and create new log.
     *
     * @return boolean
     */
    public function orderStatusUpdate($request, $paid = null)
    {
        // return $request;

        $orderStatusLog = new OrderStatusLog();
        $orderInfo = Order::find($request->orderId);

        //Order status save if pass the condition
        $orderStatusLog->order_id = $request->orderId;
        $orderStatusLog->status = $request->status;
        $orderStatusLog->note = $request->note;
        $orderStatusLog->addedBy = Auth::user()->userId ?? '1';
        $orderStatusLog->save();

        //Order last status save in the order_info table
        $orderInfo->last_status = $request->status;
        if (!empty($request->payment_status)) {
            $orderInfo->payment_status = $request->payment_status;
        }

        if (!empty($request->delivery_company)) {
            $orderInfo->delivery_service = $request->delivery_company;
        }
        $orderInfo->save();
    }

    /**
     * Return a order product based on input quantity
     * Restock that order item in the database Stock table again.
     *
     * @throws Some_Exception_Class If something goes wrong in DB transaction
     *
     * @return boolean
     */
    private function returnOrder($data)
    {
        try {
            $orderedProduct = OrderProduct::with('order', 'order.orderStatusLogs')->find($data['orderItemId']);
            DB::transaction(function () use ($data,$orderedProduct) {
                $orderedProduct->quiantity = $data['previousQuantity'] - $data['returnQuantity'];
                $orderedProduct->total = ($data['returnQuantity'] - $data['returnQuantity']) * $orderedProduct->price;
                $orderedProduct->returned = $orderedProduct->returned + $data['returnQuantity'];
                if ($data['previousQuantity'] - $data['returnQuantity'] == 0) {
                    $orderedProduct->discount = 0;
                }
                $orderedProduct->save();

                $stock = new Stock();
                $stock->fkskuId = $orderedProduct->fkskuId;
                $stock->batchId = $orderedProduct->batch_id;
                $stock->order_id = $orderedProduct->fkorderId;
                $stock->stock = $data['returnQuantity'];
                $stock->type = 'in';
                $stock->identifier = 'return_stock';
                $stock->save();

                $orderedProduct->order->orderTotal = OrderProduct::where('fkorderId', $orderedProduct->fkorderId)->sum('total');
                $orderedProduct->order->save();
            });
            // $return = $orderedProduct->fkorderId;
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function deliveryBalanceAdd($request)
    {
        try {
            $deliveryServiceBalance = new DeliveryBalance();
            $deliveryServiceBalance->deliveryServiceId = $request->delivery_company;
            $deliveryServiceBalance->orderId = $request->orderId;
            $deliveryServiceBalance->amount = $request->deliveryFee ?? 0;
            $deliveryServiceBalance->type = 'in';
            $deliveryServiceBalance->save();

            $orderTranscation = new Transaction();
            $orderTranscation->fkorderId = $request->orderId;
            $orderTranscation->amount = $request->deliveryFee;
            $orderTranscation->payment_type = 'delivery';
            $orderTranscation->advance_note = null;
            $orderTranscation->method = 'Cash';
            $orderTranscation->comment = $request->orderNote ?? null;
            $orderTranscation->reciveBy = Auth::user()->userId ?? 1;
            $orderTranscation->save();

            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function returnModal(Request $request)
    {
        $orderedProduct = OrderProduct::find($request->orderItemId);

        return view('order.returnOrderModal', compact('orderedProduct'));
    }

    public function singleReturn(Request $request)
    {
        $this->validate($request, [
            'rQuantity' => 'numeric|min:1|max:'.$request->previousQuantity,
        ],
        [
            'rQuantity.max' => 'Quantity can be maximum '.$request->previousQuantity,
        ]);

        $request['returnQuantity'] = $request->rQuantity;
        $this->returnOrder($request);
    }

    public function invoiceDownload($orderId)
    {
        $order = Order::with(['orderedProduct', 'orderedProduct.sku', 'orderedProduct.sku.product'])->find($orderId);
        $settings = Settings::first();
        $pdf = PDF::loadView('order.invoice', [
            'orderInfo' => $order, 'settings' => $settings, 'format' => 'A4',
        ]);
        $order->print = '1';
        $order->save();

        return $pdf->download('invoice - '.$order->orderId.'.pdf');
    }
}
