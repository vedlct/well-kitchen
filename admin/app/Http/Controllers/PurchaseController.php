<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sku;
use App\Models\Batch;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    public function index(){
        $vendor = Vendor::all();
        return view('purchase.index',compact('vendor'));
    }

    public function list(Request $data){

    $purchase = Batch::select(DB::raw('ifnull(GROUP_CONCAT(CASE WHEN variationrelation.skuID THEN variation.variationValue END), "single") as variationdata'), DB::raw('ifnull(stock_record.stock, 0) as Quantity'),
       'batch.batchId','batch.created_at','batch.updated_at','product.productName', 'product.type', 'vendor.vendor_shop_name')
       ->leftjoin('sku','sku.skuId', 'batch.skuId' )
       ->leftjoin('vendor','batch.vendor', 'vendor.vendor_id' )
       ->leftjoin('product','product.productId', 'sku.fkproductId' )
       ->leftjoin('variationrelation','variationrelation.skuID', 'sku.skuId' )
       ->leftjoin('variation','variation.variationID', 'variationrelation.variationData' )
       ->leftjoin('stock_record','stock_record.batchId', 'batch.batchId' )
       ->where('stock_record.type', 'in')
       ->where('stock_record.identifier' , 'purchase')
       ->groupby('batch.batchId')
       ->orderby('batch.batchId' ,'DESC');
   
       
    //return $purchase=Batch::with('stock','sku','sku.variationRelation','sku.variationRelation.variationDetailsData','sku.product','sku.product.images','vendorData')->get();
        // if ($data->start_date != 'Invalid date' && $data->end_date != 'Invalid date'){
        //     $purchase = $purchase->whereBetween('created_at',[$data->start_date." 00:00:00",$data->end_date." 23:59:59"]);
        // }

        if (!empty($data->fromDate) && empty($data->toDate) && empty($data->vendorInfo)) {
            $purchase = $purchase->whereDate('batch.created_at', $data->fromDate);
        }

        if (!empty($data->toDate) && empty($data->fromDate) && empty($data->vendorInfo)) {
            $purchase = $purchase->whereDate('batch.created_at', $data->toDate);
        }

        if (!empty($data->fromDate) && !empty($data->toDate) && empty($data->vendorInfo)) {
            $purchase = $purchase->where('batch.created_at', '>=', $data->fromDate.' 12:00:00')
                ->where('batch.created_at', '<=', $data->toDate.' 23:59:59');
        }

        if (empty($data->fromDate) && empty($data->toDate) && !empty($data->vendorInfo)) {
            $purchase = $purchase->where('vendor.vendor_shop_name', $data->vendorInfo);
        }

        if (!empty($data->fromDate) && empty($data->toDate) && !empty($data->vendorInfo)) {
            $purchase = $purchase->where('vendor_shop_name', $data->vendorInfo)->whereDate('batch.created_at', $data->fromDate);
        }

        if (empty($data->fromDate) && !empty($data->toDate) && !empty($data->vendorInfo)) {
            $purchase = $purchase->where('vendor.vendor_shop_name', $data->vendorInfo)->whereDate('batch.created_at', $data->toDate);
        }

        if (!empty($data->fromDate) && !empty($data->toDate) && !empty($data->vendorInfo)) {
            $purchase = $purchase->where('batch.created_at', '>=', $data->fromDate.' 12:00:00')
                ->where('batch.created_at', '<=', $data->toDate.' 23:59:59')
                ->where('vendor.vendor_shop_name', $data->vendorInfo);
        }

        // if($data->vendorInfo != ''){
        //     $purchase = $purchase->where('vendor.vendor_shop_name',$data->vendorInfo);
        // }
        return Datatables::of($purchase)
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
            ->addColumn('stock_available', function($stock_available) {
                $inStock = Stock::where('batchId', $stock_available->batchId)->where('type', 'in')->sum('stock');
                $outStock = Stock::where('batchId', $stock_available->batchId)->where('type', 'out')->sum('stock');
                $stockAvailable = $inStock - $outStock;
                return $stockAvailable;
            })
            ->addColumn('action', function($action) {
                return '<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="editBatch('.$action->batchId.')" title="Purchase"><i class="ft-edit-3"></i></a>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="returnBatch('.$action->batchId.')" title="Return"><i class="ft-corner-down-left"></i></a>';
            })
            ->rawColumns(['action','variation'])
            ->make(true);
    }

    public function edit(Request $data){
        $batch = Batch::with('sku','stock')->find($data->batchId);
        if ($data->newPurchase == 'true'){
            $quantity = '0';
        }else{
           $quantity = $batch->stock->stock;
        }
        data_set($batch, 'quantity', $quantity);
        data_set($batch, 'newPurchase', $data->newPurchase);
        $vendorInfo = Vendor::where('status','active')->get();
        $store = Store::get();
        return view('purchase.modal',compact('data','batch','vendorInfo','store'));
    }

    public function store(Request $data)
    {
        // return $data;
        $this->validate($data, [
            'store' => 'required',
            'vendor' => 'required',
            'purchasePrice' => 'required|numeric',
            'quantity' => 'required_with:batch|numeric',
            'vatType' => 'required',
            'vat' => 'required|numeric',
            'purchaseDate' => 'required',
        ]);

        if(empty($data->batch)){
            $batch = new Batch();
        }else{
            $batch = Batch::find($data->batch);
        }
        
        $batch->skuId = $data->sku;
        $batch->vendor = $data->vendor;
        $batch->storeId = $data->store;
        $batch->purchasePrice = $data->purchasePrice;
        $batch->salePrice = Sku::find($data->sku)->pluck('salePrice') ?? '0';
        $batch->vatType = $data->vatType;
        $batch->quantity = $data->quantity;
        $batch->vat = $data->vat;
        $batch->created_at = Carbon::parse($data->purchaseDate)->timestamp;
        $batch->save();

        // if(empty($data->batch)){
        //     $stock = new Stock();
        // }else{
        //     $stock = Stock::where('batchId',$data->batch)->first();
        // }
        // $stock->fkskuId = $data->sku;
        // $stock->batchId = $batch->batchId;
        // $stock->stock = $data->quantity;
        // $stock->type = 'in';
        // $stock->identifier = 'purchase';
        // $stock->save();
        
        // return response()->json(array(
        //     'batchId'=>$batch->batchId,
        //     'sku'=>$data->sku,
        //     'quantity'=>$data->quantity,
        //     'purchasePrice'=>$batch->purchasePrice,
        //     'store'=> $batch->storeId,
        //     'success'=>true,
        // ));

        if(!empty($data->batch)){
            $batch = Batch::find($data->batch);
          
            $stock = new Stock();
            $stock->type = $data->type;
            $stock->identifier = 'edit';
        }else{ 
            $stock = new Stock();
            $stock->type = 'in';
            $stock->identifier = 'purchase';
            
          }
    
       
        $stock->fkskuId = $data->sku;
        $stock->batchId = $batch->batchId;
        $stock->stock = $data->quantity;
        
        $stock->save();
        
        return response()->json(array(
            'batchId'=>$batch->batchId,
            'sku'=>$data->sku,
            'quantity'=>$data->quantity,
            'purchasePrice'=>$batch->purchasePrice,
            'store'=> $batch->storeId,
            'success'=>true,
        ));
    }

    public function add(){
        $vendor=Vendor::all();
        $store=Store::all();
        return view('purchase.add',compact('vendor','store'));
    }

    public function skuWithBatch(Request $r){

        $sku=collect(DB::select(DB::raw("SELECT batch.batchId,batch.created_at,batch.updated_at, product.productName , product.type, vendor.vendor_shop_name , ifnull(stock_record.stock, 0) as Quantity , sku.skuId ,
                    ifnull(GROUP_CONCAT(CASE WHen variationrelation.skuId THEN variation.variationValue END), 'single') as variationdata
                    FROM `batch` 
                    LEFT JOIN sku ON sku.skuId = batch.skuId
                    LEFT JOIN vendor ON batch.vendor = vendor.vendor_id
                    LEFT JOIN product ON product.productId = sku.fkproductId
                    LEFT JOIN variationrelation ON variationrelation.skuID = sku.skuId
                    LEFT JOIN variation ON variation.variationId = variationrelation.variationData
                    LEFT JOIN stock_record ON stock_record.batchId = batch.batchId AND stock_record.type = 'in' AND stock_record.identifier = 'purchase' WHERE batch.skuId = $r->sku
                    GROUP BY batch.batchId  
                    ORDER BY `product`.`type` ASC")));
        return $sku;

    }

    public function batchDelete(Request $r){
       $batchStockOut=Stock::where('batchId',$r->batchId)->where('type','out')->first();
       try {
        if(!isset($batchStockOut)){
            $batch=Batch::find($r->batchId);
            $batch->delete();
            return response()->json([
                                    'message'=>'Batch deleted successfully',
                                    'deleted'=>true  
                                    ]);
        }
        else{
            return response()->json(['message'=>'Batch can not be deleted']);
        }
       } catch (\Throwable $th) {
        return response()->json(['message'=>'Batch can not be deleted']);
       }
        
    }

    public function editBatch(Request $r){
        $batch=Batch::find($r->batchId);
        return $batch;
    }
}
