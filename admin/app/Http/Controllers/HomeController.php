<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        day wise data
        $date = date('Y-m-d');

        $todayOrder = Order::select(DB::raw('COALESCE(COUNT(*), 0) as totalOrder'))
            ->where('order_info.created_at', '>=', $date.' 00:00:00')
            ->where('order_info.created_at', '<=', $date.' 23:59:59')
            ->first();
// dd($todayOrder->totalOrder);
        $purchasePrice = Batch::select(DB::raw('COALESCE(SUM(batch.purchasePrice), 0) as totalPurchasePrice'))
            ->where('batch.created_at', '>=', $date.' 00:00:00')
            ->where('batch.created_at', '<=', $date.' 23:59:59')
            ->first();

        $orderPrice = Order::select(DB::raw('COALESCE(SUM(order_info.orderTotal), 0) as totalOrderAmount'))
            ->where('order_info.created_at', '>=', $date.' 00:00:00')
            ->where('order_info.created_at', '<=', $date.' 23:59:59')
            ->first();

        $totalOrder = Order::select(DB::raw('COALESCE(COUNT(*), 0) as totalOrder'))
            ->first();
// dd($totalOrder->todayOrder);
        $orderComplete = Order::select(DB::raw('COALESCE(COUNT(*), 0) as totalOrderComplete'))
            ->where('order_info.last_status', '=', 'complete')
            ->first();

        $todayCollection = Transaction::select(DB::raw('COALESCE(SUM(transaction.amount), 0) as todayCollection'))
            ->where('transaction.created_at', '>=', $date.' 00:00:00')
            ->where('transaction.created_at', '<=', $date.' 23:59:59')
            ->first();
//        day wise data end

//        month wise data
        $startDate = Carbon::now(); //returns current day
        $firstDay = $startDate->firstOfMonth()->format('Y-m-d');
        $lastDay = $startDate->lastOfMonth()->format('Y-m-d');

        $purchaseInMonth = Batch::select(DB::raw('COALESCE(SUM(purchasePrice), 0) as purchaseInMonth'))
            ->where('batch.created_at', '>=', $firstDay.' 00:00:00')
            ->where('batch.created_at', '<=', $lastDay.' 23:59:59')
            ->first();

        $saleInMonth = Order::select(DB::raw('COALESCE(SUM(orderTotal), 0) as saleInMonth'))
            ->where('order_info.created_at', '>=', $firstDay.' 00:00:00')
            ->where('order_info.created_at', '<=', $lastDay.' 23:59:59')
            ->first();

        $collectionInMonth = Transaction::select(DB::raw('COALESCE(SUM(amount), 0) as collectionInMonth'))
            ->where('transaction.created_at', '>=', $firstDay.' 00:00:00')
            ->where('transaction.created_at', '<=', $lastDay.' 23:59:59')
            ->first();

        $recentOrders = Order::orderBy('created_at', 'desc')->take(7)->get();

        $topSalingProducts = OrderProduct::select(DB::raw('COUNT(order_item.order_itemId) as topproduct'), 'product.productId', 'product.productName')
            ->leftjoin('sku', 'sku.skuId', 'order_item.fkskuId')
            ->leftjoin('product', 'product.productId', 'sku.fkproductId')
            ->groupby('product.productId')
            ->orderby('topproduct', 'DESC')
            ->limit(7)
            ->get();

//        chart
        $topCategories = OrderProduct::select(DB::raw('COUNT(order_item.order_itemId) as topcaterogy'), 'category.categoryName')
            ->leftjoin('order_info', 'orderId', 'fkorderId')
            ->leftjoin('sku', 'skuId', 'fkskuId')
            ->leftjoin('product', 'productId', 'sku.fkproductId')
            ->leftjoin('category', 'category.categoryId', 'product.categoryId')
            ->whereDate('order_info.created_at', '>=', $firstDay)
            ->whereDate('order_info.created_at', '<=', $lastDay)
            ->groupby('category.categoryId')
            ->orderby('topcaterogy', 'DESC')
            ->limit(10)
            ->get();

        $last7dayssales = Order::select(DB::raw('COALESCE(SUM(orderTotal), 0) as totalsale'), DB::raw('date(order_info.created_at) as saledate'))
            ->groupby(DB::raw('date(order_info.created_at)'))
            ->orderby(DB::raw('date(order_info.created_at)'), 'DESC')
            ->limit(7)
            ->get();

        return view('index', compact('topCategories', 'purchasePrice', 'orderPrice', 'todayOrder', 'totalOrder', 'orderComplete', 'todayCollection', 'purchaseInMonth', 'saleInMonth', 'collectionInMonth', 'recentOrders', 'topSalingProducts', 'last7dayssales'));
    }
}
