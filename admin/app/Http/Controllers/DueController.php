<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DueController extends Controller
{
    public function index()
    {
        return view('due.index');
    }

    public function DueList(Request $request)
    {
        $due = Order::select(DB::raw('order_info.orderTotal - ifnull(SUM(amount), 0) as due'), 'orderId', 'user.firstName', 'order_info.orderTotal')
                                ->leftjoin('transaction', 'order_info.orderId', 'transaction.fkorderId')
                                ->leftjoin('customer', 'order_info.fkcustomerId', 'customer.customerId')
                                ->leftjoin('user', 'customer.fkuserId', 'user.userId')
                                ->groupby('orderId')
                                ->havingRaw('due > 0');

        return datatables($due)->make(true);
    }
}
