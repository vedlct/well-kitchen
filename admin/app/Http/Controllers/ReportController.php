<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ReportController extends Controller
{
//    sale report
    public function sale()
    {
        return view('report.sale');
    }

    public function saleReport(Request $request)
    {
        $sale = Order::select('order_info.payment_status', 'order_info.orderId', 'order_info.orderTotal', 'order_info.created_at as ordered', 'order_info.updated_at', 'order_info.created_at', 'customer.phone', 'user.firstName')
            ->leftJoin('customer', 'order_info.fkcustomerId', 'customer.customerId')
            ->leftJoin('user', 'user.userId', 'customer.fkuserId')
            ->where('order_info.payment_status', 'paid')
            ->orderBy('order_info.orderId', 'desc');

        if (!empty($request->fromDate) && empty($request->toDate)) {

            $sale = $sale->whereDate('order_info.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate)) {
            $sale = $sale->whereDate('order_info.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $sale = $sale->where('order_info.created_at', '>=', $request->fromDate . " 12:00:00")
                ->where('order_info.created_at', '<=', $request->toDate . " 23:59:59");
        }

        $sale = $sale->get();

        $datatables = Datatables::of($sale)
            ->with('totalSale', $sale->sum('orderTotal'));

        return $datatables->make(true);
    }

//    stock report
    public function stock()
    {
        return view('report.stock');
    }

    public function stockReport(Request $request)
    {
        $product =Stock::select('stock_record.fkskuId', 'sku.fkproductId', 'product.productName',
            DB::raw("COALESCE(SUM(CASE WHEN stock_record.type = 'in' AND stock_record.identifier = 'purchase' THEN stock_record.stock END), 0) as totalPurchase"),
            DB::raw("COALESCE(SUM(CASE WHEN stock_record.type = 'out' AND stock_record.identifier = 'sale' THEN stock_record.stock END), 0) as totalSale"),
            DB::raw("COALESCE(SUM(CASE WHEN stock_record.type = 'in' AND stock_record.identifier = 'return_stock' THEN stock_record.stock END), 0) as returnStock"),
            DB::raw('ifnull(GROUP_CONCAT(CASE WHEN variationrelation.skuID THEN variation.variationValue END), "single") as variationdata'),
            DB::raw('COALESCE(SUM(CASE WHEN stock_record.type = "in" THEN stock END), 0) - COALESCE(SUM(CASE WHEN stock_record.type = "out" THEN stock END), 0) as available'))
            ->join ('sku', 'sku.skuId', '=', 'stock_record.fkskuId')
            ->leftjoin('product', 'product.productId', '=', 'sku.fkproductId')
            ->leftjoin('variationrelation', 'variationrelation.skuId', '=', 'sku.skuId')
            ->leftjoin('variation', 'variationrelation.variationData', '=', 'variation.variationId')
            ->groupBy('sku.skuId')
            ->orderBy('available', 'DESC');



        $product = $product->get();

        return datatables()->of($product)
            ->addColumn('variation', function($variation) {
                if(str_contains($variation->variationdata,'#')){
                    $colorPosition=strpos($variation->variationdata,'#');
                    $otherVariation=substr($variation->variationdata,$colorPosition+7);
                    $color=strtok($variation->variationdata,',');
                    $colorname = (unserialize (COLOR_CODE));
                    $variationValue=$colorname[strtoupper($color)] ?? 'none';
                    return $variationValue.$otherVariation;
                }else{
                    return $variation->variationdata;
                }
            })
            ->rawColumns(['variation'])
            ->make(true);
    }

//    product report
    public function product()
    {
        return view('report.product');
    }

    public function productReport(Request $request)
    {
        $products = OrderProduct::select('product.productId', 'product.productName', 'product.type', DB::raw('ifnull(GROUP_CONCAT(CASE WHEN variationrelation.skuID THEN variation.variationValue END), "single") as variationdata'), DB::raw('COALESCE(SUM(order_item.quiantity), 0) as totalQuantity'))
            ->leftjoin('order_info', 'order_info.orderId', '=', 'order_item.fkorderId')
            ->leftjoin('sku', 'sku.skuId', '=', 'order_item.fkskuId')
            ->leftjoin('variationrelation', 'variationrelation.skuId', '=', 'sku.skuId')
            ->leftjoin('variation', 'variationrelation.variationData', '=', 'variation.variationId')
            ->leftjoin('product', 'product.productId', '=', 'sku.fkproductId')
            ->groupBy('sku.skuId');

        if (!empty($request->fromDate) && empty($request->toDate)) {
            $products = $products->whereDate('order_info.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate)) {
            $products = $products->whereDate('order_info.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $products = $products->whereDate('order_info.created_at', '>=', $request->fromDate)
                ->whereDate('order_info.created_at', '<=', $request->toDate);
        }

        $products = $products->get();
        return datatables()->of($products)
            ->addColumn('variation', function($variation) {
                if(str_contains($variation->variationdata,'#')){
                    $colorPosition=strpos($variation->variationdata,'#');
                    $otherVariation=substr($variation->variationdata,$colorPosition+7);
                    $color=strtok($variation->variationdata,',');
                    $colorname = (unserialize (COLOR_CODE));
                    $variationValue=$colorname[strtoupper($color)] ?? 'none';
                    return $variationValue.$otherVariation;
                }else{
                    return $variation->variationdata;
                }
            })
            ->rawColumns(['variation'])
          ->make(true);
    }

//    product report detail
    public function productDetail($id){
        $productId = $id;
        return view('report.productDetail', compact('productId'));
    }

    public function productReportDetail(Request $request)
    {
        $products = OrderProduct::select('product.productId', 'order_info.orderId', 'order_info.discount', 'order_info.created_at', 'order_info.last_status', 'batch.purchasePrice', 'batch.salePrice', 'product.productName', DB::raw('SUM(order_item.quiantity) as totalQuantity'))
            ->leftjoin('order_info', 'order_info.orderId', '=', 'order_item.fkorderId')
            ->leftjoin('sku', 'sku.skuId', '=', 'order_item.fkskuId')
            ->leftjoin('batch', 'batch.batchId', '=', 'order_item.batch_id')
            ->leftjoin('product', 'product.productId', '=', 'sku.fkproductId')
            ->where('product.productId', $request->productId)
            ->groupBy('order_info.orderId');

        $products = $products->get();

        return datatables()->of($products)
            ->make(true);
    }

//    customer report
    public function customer()
    {
        return view('report.customer');
    }

    public function customerReport(Request $request)
    {
        $customer = Customer::select('user.firstName', 'customer.phone', 'customer.membership', 'customer.customerId',
            DB::raw('COALESCE(SUM(order_info.orderTotal), 0) as customerTotal'),
            DB::raw('COALESCE(count(*), 0) as total'),
            DB::raw('SUM(transaction.amount) as totalPaid'),
            DB::raw('SUM(order_info.orderTotal) - SUM(transaction.amount) as totalDue'))
            ->join('order_info', 'order_info.fkcustomerId', '=', 'customer.customerId')
            ->join('transaction', 'transaction.fkorderId', '=', 'order_info.orderId')
            ->leftjoin('order_item', 'order_item.fkorderId', '=', 'order_info.orderId')
            ->leftjoin('user', 'user.userId', '=', 'customer.fkuserId')
            ->orderBy('order_info.orderId', 'desc')
            ->groupBy('order_info.fkcustomerId');

        if (!empty($request->fromDate) && empty($request->toDate)) {
            $customer = $customer->whereDate('order_info.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate)) {
            $customer = $customer->whereDate('order_info.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $customer = $customer->where('order_info.created_at', '>=', $request->fromDate . " 12:00:00")
                ->where('order_info.created_at', '<=', $request->toDate . " 23:59:59");
        }

        $customer = $customer->get();

        return datatables()->of($customer)
            ->make(true);
    }

//    customer report detail
    public function customerDetail($id){
        $customerId = $id;
        return view('report.customerDetail', compact('customerId'));
    }

    public function customerReportDetail(Request $request)
    {
        $customers = Order::select('customer.customerId', 'order_item.price', 'order_item.quiantity', 'order_item.total', 'order_item.discount',  'order_info.orderId', 'order_info.created_at as ordered_at', 'product.productName')
            ->leftjoin('customer', 'order_info.fkcustomerId', '=', 'customer.customerId')
            ->leftjoin('order_item', 'order_item.fkorderId', '=', 'order_info.orderId')
            ->leftjoin('sku', 'order_item.fkskuId', '=', 'sku.skuId')
            ->leftjoin('product', 'product.productId', '=', 'sku.fkproductId')
            ->where('order_info.fkcustomerId', $request->customerId);

        $customers = $customers->get();

        return datatables()->of($customers)
            ->make(true);
    }


//    category report
    public function category()
    {
        return view('report.category');
    }

    public function categoryReport(Request $request)
    {
        $category = OrderProduct::select('category.categoryId', 'category.categoryName', DB::raw('COALESCE(SUM(order_item.quiantity), 0) as totalQuantity'))
            ->leftjoin('order_info', 'order_info.orderId', '=', 'order_item.fkorderId')
            ->leftjoin('sku', 'sku.skuId', '=', 'order_item.fkskuId')
            ->leftjoin('product', 'product.productId', '=', 'sku.fkproductId')
            ->join('category', 'category.categoryId', '=', 'product.categoryId')
            ->groupBy('product.categoryId');

        if (!empty($request->fromDate) && empty($request->toDate)) {
            $category = $category->whereDate('order_info.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate)) {
            $category = $category->whereDate('order_info.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $category = $category->where('order_info.created_at', '>=', $request->fromDate . " 12:00:00")
                ->where('order_info.created_at', '<=', $request->toDate . " 23:59:59");
        }

        $category = $category->get();

        return datatables()->of($category)
            ->make(true);
    }

//    store report
    public function store()
    {
        $purchaseInfo =Stock::select('batch.storeId',
            DB::raw("COALESCE(SUM(CASE WHEN stock_record.type = 'in' AND stock_record.identifier = 'purchase' THEN stock_record.stock END), 0) as totalPurchase"),
            DB::raw("COALESCE(SUM(CASE WHEN stock_record.type = 'in' AND stock_record.identifier = 'purchase' THEN stock_record.stock*batch.purchasePrice END), 0) as totalPurchasePrice"),
            DB::raw('COALESCE(SUM(CASE WHEN type = "in" THEN stock END), 0) - COALESCE(SUM(CASE WHEN type = "out" THEN stock END), 0) as available'))
            ->leftjoin ('batch', 'batch.batchId', '=', 'stock_record.batchId')
            ->groupBy('batch.storeId')->get();

        $saleInfo =OrderProduct::select('batch.storeId',  DB::raw('COALESCE(SUM(quiantity), 0) as totalSale'), DB::raw('COALESCE(SUM(total), 0) as totalSalePrice'))
            ->leftjoin ('batch', 'batch.batchId', '=', 'order_item.batch_id')
            ->groupBy('batch.storeId')->get();

        $stores = Store::all();
        return view('report.store', compact('stores', 'saleInfo', 'purchaseInfo'));
    }

    public function storeReport(Request $request)
    {

    }

//    vendor report
    public function vendor()
    {
        return view('report.vendor');
    }

    public function vendorReport(Request $request)
    {
        $vendor = Batch::select('vendor.vendor_shop_name', 'vendor.vendor_id', 'vendor.vendor_phone', DB::raw('COALESCE(SUM(batch.quantity), 0) as totalQuantity'),
            DB::raw('SUM(batch.purchasePrice) as totalPurchasePrice'))
            ->leftjoin('vendor', 'vendor.vendor_id', '=', 'batch.vendor')
            ->groupBy('batch.vendor');

        if (!empty($request->fromDate) && empty($request->toDate)) {

            $vendor = $vendor->whereDate('batch.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate)) {
            $vendor = $vendor->whereDate('batch.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $vendor = $vendor->where('batch.created_at', '>=', $request->fromDate . " 12:00:00")
                ->where('batch.created_at', '<=', $request->toDate . " 23:59:59");
        }

        $vendor = $vendor->get();

        return datatables()->of($vendor)
            ->make(true);
    }

//    vendor detail
    public function vendorDetail($id)
    {
        $vendorId = $id;
        return view('report.vendorDetail', compact('vendorId'));
    }

    public function vendorReportDetail(Request $request)
    {
        $vendor = Batch::select('vendor.vendor_shop_name', 'batch.created_at as purchaseDate', DB::raw('COALESCE(SUM(batch.quantity), 0) as totalQuantity'),
            DB::raw('SUM(batch.purchasePrice) as totalPurchasePrice'))
            ->leftjoin('vendor', 'vendor.vendor_id', '=', 'batch.vendor')
            ->where('vendor.vendor_id', $request->vendorId)
            ->groupBy('batch.created_at');

        if (!empty($request->fromDate) && empty($request->toDate)) {

            $vendor = $vendor->whereDate('batch.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate)) {
            $vendor = $vendor->whereDate('batch.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $vendor = $vendor->where('batch.created_at', '>=', $request->fromDate . " 12:00:00")
                ->where('batch.created_at', '<=', $request->toDate . " 23:59:59");
        }

        $vendor = $vendor->get();

        return datatables()->of($vendor)
            ->make(true);
    }

//    transaction report
    public function transaction()
    {
        $totalOrder =  Order::all()->sum('orderTotal');
        $totalTransaction = Transaction::all()->sum('amount');
        $totalDueUptoToday = $totalOrder - $totalTransaction;
        $today = date('Y-m-d H:i:s');

//        $orderIds = Order::select('order_info.orderId')->where('order_info.created_at', '>=', "2021-02-23 12:00:00")
//            ->where('order_info.created_at', '<=', "2021-02-23 23:59:59")->get();

        return view('report.transaction');
    }

    public function transactionReport(Request $request)
    {

        $today = date('Y-m-d H:i:s');

        $totalOrder =  Order::all()->sum('orderTotal');
        $totalTransaction = Transaction::all()->sum('amount');
        $totalDueUptoToday = $totalOrder - $totalTransaction;

        $transaction = Order::select(DB::raw('SUM(order_info.orderTotal) as totalOrder'), DB::raw('SUM(transaction.amount) as totalCollect'),
            DB::raw('SUM(order_info.orderTotal) - SUM(transaction.amount) as totalDue'))
            ->join('transaction', 'transaction.fkorderId', '=', 'order_info.orderId');

        if (empty($request->fromDate) && empty($request->toDate)) {
            $orderIds = Order::whereDate('order_info.created_at', $today)->pluck('orderId');
            $transaction = $transaction->whereIn('fkorderId', $orderIds)->whereDate('transaction.created_at', $today);
        }

        if (!empty($request->fromDate) && empty($request->toDate)) {
            $orderIds = Order::whereDate('order_info.created_at',  $request->fromDate)->pluck('orderId');
            $transaction = $transaction->whereIn('fkorderId', $orderIds)->whereDate('transaction.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate)) {
            $orderIds = Order::whereDate('order_info.created_at',  $request->toDate)->pluck('orderId');
            $transaction = $transaction->whereIn('fkorderId', $orderIds)->whereDate('transaction.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $orderIds = Order::where('order_info.created_at', '>=',  $request->fromDate . " 12:00:00")
                ->where('order_info.created_at', '<=',  $request->toDate . " 23:59:59")->pluck('orderId');

            $transaction = $transaction->whereIn('fkorderId', $orderIds)->where('transaction.created_at', '>=', $request->fromDate . " 12:00:00")
                ->where('transaction.created_at', '<=', $request->toDate . " 23:59:59");
        }


        return datatables()->of($transaction)
            ->with('totalDueUptoToday', $totalDueUptoToday)
        ->make(true);
    }

//    collection report
    public function collection(){
        return view('report.collection');
    }

    public function collectionReport(Request $request){
        $today = date('Y-m-d H:i:s');
        $collection = Transaction::select('transaction.fkorderId', 'user.firstName', 'customer.phone', 'transaction.created_at as collectionDate',
            DB::raw('ROUND(SUM(transaction.amount),0) as totalAmount'))
            ->leftjoin('order_info', 'transaction.fkorderId', '=', 'order_info.orderId')
            ->leftjoin('customer', 'order_info.fkcustomerId', '=', 'customer.customerId')
            ->leftjoin('user', 'user.userId', '=', 'customer.fkuserId')
            ->orderBy('transaction.created_at', 'DESC')
            ->groupBy('transaction.fkorderId');

        if (empty($request->fromDate) && empty($request->toDate)) {
            $collection = $collection->whereDate('transaction.created_at', $today);
        }

        if (!empty($request->fromDate) && empty($request->toDate)) {

            $collection = $collection->whereDate('transaction.created_at', $request->fromDate);
        }

        if (!empty($request->toDate) && empty($request->fromDate)) {
            $collection = $collection->whereDate('transaction.created_at', $request->toDate);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $collection = $collection->where('transaction.created_at', '>=', $request->fromDate . " 12:00:00")
                ->where('transaction.created_at', '<=', $request->toDate . " 23:59:59");
        }
        $collection = $collection->get();

        $datatables = Datatables::of($collection)
            ->with('totalCollection', $collection->sum('totalAmount'));

        return $datatables->make(true);
    }

}
