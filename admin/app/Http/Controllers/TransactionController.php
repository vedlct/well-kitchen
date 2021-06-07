<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Receive payment information.
     *
     * @param array contains instance of Request instance
     *
     * @return array with message and status code
     * @return bool  (true) ? "success" : "failed"
    **/
    public static function orderTransaction($request)
    {
        try {
            $orderTranscation = new Transaction();
            $orderTranscation->fkorderId = $request->orderId;
            $orderTranscation->amount = $request->paid_amount ?? '0';
            $orderTranscation->payment_type = $request->payment_type ?? 'normal';
            $orderTranscation->advance_note = $request->orderNote ?? null;
            $orderTranscation->method = $request->payment_method ?? 'Cash';
            $orderTranscation->comment = $request->orderNote ?? null;
            $orderTranscation->reciveBy = Auth::user()->userId ?? 1;
            $orderTranscation->save();
        } catch (\Throwable $th) {
            throw $th;
        }

        return true;
    }

    /**
     * Receive an orderID.
     *
     * @param int contains orderID
     *
     * @return object with view (modal) contains payment form.
     */
    public function addPayment(Request $request)
    {
        $orderInfo = Order::with('customer', 'transaction')->find($request->orderId);

        return view('transaction.paymentModal', compact('orderInfo'));
    }

    /**
     * Receive payment information from order page
     * after validating data passing to @orderTransaction(#data).
     *
     * @param array contains instance of Request instance
     *
     * @return array with message and status code
     */
    public function savePayment(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            // 'paymentMethod' => 'required',
        ]);
        $request['paid_amount'] = $request->amount;
        $transaction = $this->orderTransaction($request);
        if ($transaction === true) {
            return response()->json(['message' => 'payment successfull', 200]);
        } else {
            return response()->json(['message' => 'payment is failed successfull', 400]);
        }
    }
}
