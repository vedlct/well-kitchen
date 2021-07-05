<?php

namespace App\Http\Controllers;

use Session;
use App\Models\HotDeals;
use App\Models\Hotdeals as ModelsHotdeals;
use App\Models\Product;
use App\Models\HotDealsProduct;
use Illuminate\Http\Request;
use DB;

class HotDealsController extends Controller
{
    public function index()
    {
        return view('hotdeals.index');
    }

    public function add()
    {
        $products = Product::all();
        return view('hotdeals.add_deals', compact('products'));
    }

    public function edit($id)
    {
        $products = Product::all();
        $deals = Hotdeals::findOrFail($id);
        // $new[0]=date('Y-m-d', strtotime($deals->startDate));
        // $new[1]=date('Y-m-d', strtotime($deals->endDate));
        // $date=implode('-', $new);


        return view('hotdeals.edit_deals', compact('deals', 'products'));
    }

    public function save_deals(Request $r)
    {
        // dd($r->all());
        $this->validate($r,[
            'startDate' => 'required|date_format:Y-m-d H:i:s|after:today|before:endDate',
            'endDate' => 'required|date_format:Y-m-d H:i:s|after:startDate',
            'amount' => 'required|numeric',
            'percentage' => 'required',
            'hotDeals_name' =>'required',
//            'imageLink' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required'
        ]);
        $deals = new Hotdeals();
        $deals->hotDeals_name = $r->hotDeals_name;
        $deals->startDate =date('Y-m-d h:i:s', strtotime($r->startDate));
        $deals->endDate =date('Y-m-d h:i:s', strtotime($r->endDate));
        $deals->amount = $r->amount;
        $deals->percentage = $r->percentage;
        $deals->status = $r->status;
        $deals->save();
        $length = count($r->value);
        for ($i = 0; $i < $length; $i++) {
            $dealsProduct = new HotDealsProduct();
            $dealsProduct->fkhotdealsId = $deals->hotDealsId;
            $dealsProduct->fkproductId = $r->value[$i];
            $dealsProduct->quantity = $r->amount;
            $dealsProduct->save();
        }
        // return response()->json(['success'=>'Got Simple Ajax Request.']);
        return redirect()->route('hotdeals');
    }

    public function update(Request $r,$id)
    {
        // dd($r->all());

        $this->validate($r,[
            'startDate' => 'required|date_format:Y-m-d H:i:s|after:today|before:endDate',
            'endDate' => 'required|date_format:Y-m-d H:i:s|after:startDate',
            'amount' => 'required|numeric',
            'percentage' => 'required',
            'hotdeals_name' =>'required',
//            'imageLink' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required'
        ]);
        $deals = Hotdeals::findOrFail($r->id);
        $deals->hotdeals_name = $r->hotdeals_name;
        $deals->startDate = date('Y-m-d H:i:s', strtotime($r->startDate));
        $deals->endDate = date('Y-m-d H:i:s', strtotime($r->endDate));
        $deals->amount = $r->amount;
        $deals->percentage = $r->percentage;
        $deals->status = $r->status;
        $deals->save();

        // Session::flash('success', 'Category Created Successfully');
        return redirect('hotdeals')->with('success', true);
    }


    public function showDeals()
    {
        $hotDeals =Hotdeals::select('hotdeals.*', DB::raw('DATE_FORMAT(hotdeals.startDate, "%a, %b %D, %Y. %l: %i %p") as startdate'), 
                    DB::raw('DATE_FORMAT(hotdeals.endDate, "%a, %b %D, %Y. %l: %i %p") as enddate'));
        // ->get();
// dd($hotDeals);

        // $hotDeals = Hotdeals::select('hotdeals.startDate',
            // DB::raw("date(SUM(CASE WHEN stock_record.type = 'in' AND stock_record.identifier = 'purchase' THEN stock_record.stock END), 0) as totalPurchase"),
            // DB::raw("date('Y-m-d H:i:s', st) as startdate"),
        //    );
        //    dd($hotDeals->get());
        // $hotDeals = Hotdeals::all();
        return datatables()->of($hotDeals)
            ->addColumn('status', function (Hotdeals $status) {
                if ($status->status == "Available") {
                    return "<label class='btn btn-success btn-sm'>Available</label>";
                } elseif ($status->status == "Not Available") {
                    return "<label class='btn btn-danger btn-sm'>Not Available</label>";
                }
            })
            ->addColumn('percentage', '{{$percentage}}%')
            ->rawColumns(['status', 'percentage'])
            ->setRowAttr([
                'align'=>'center',
                'height'=>'50%',
            ])->make(true);
    }

    public function delete(Request $r)
    {
        $deals = Hotdeals::findOrFail($r->hotDealsId);
        $dealsProduct = HotDealsProduct::where('fkhotdealsId',$r->hotDealsId)->get()
                                                                            ->map(function($item){
                                                                                 return $item->fkproductId;
                                                                            });
        $product=Product::with('sku')->whereIn('productId',$dealsProduct)->get()
                        ->map(function($item){
                            return $item->sku->map(function($i){
                                return $i->skuId;
                            });
                    });
        if(count( $dealsProduct)>0)
        {
            return response()->json(['fail'=> $product]);
        }
        else{
        $deals->delete();
        }
    }
    public function showDealProduct($id){
        $dealsProduct = HotDealsProduct::with('product','hotdeals')->where('fkhotdealsId',$id)->get();
        // dd($dealsProduct);
        // return response()->json(['success'=> $dealsProduct]);

    //    return $dealsProduct[0]->hotdeals;
        return view('hotdeals.showProduct',compact('dealsProduct','id'));
    }

    public function hotProduct($id){
        $hotProduct= HotDealsProduct::find($id);
    }

    public function addProduct($id)
    {
        $currentProduct=HotDealsProduct::where('fkhotdealsId',$id)->get()->pluck('fkproductId');
        return view('hotdeals.addProduct',compact('currentProduct','id'));
    }

    public function productInsert(Request $request)
    {
        $hotProducts=HotDealsProduct::where('fkhotdealsId',$request->id)->get();
        if(count($hotProducts)>0){
            $quantity= $hotProducts->first()->quantity ;
        }
        HotDealsProduct::where('fkhotdealsId',$request->id)->delete();
        foreach ($request->value as $key => $item) {
            $hotProduct=new HotDealsProduct();
            $hotProduct->fkhotdealsId=$request->id;
            $hotProduct->fkproductId=$item;
            $hotProduct->quantity=$quantity ??100;
            $hotProduct->save();
        }

        return response()->json('success',200);
    }
}
