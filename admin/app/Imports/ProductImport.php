<?php

namespace App\Imports;

use App\Models\Batch;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Stock;
use App\Models\StockRecord;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{

//    public function model(array $row)
//    {
//        dd($row[0]);
//        return new Product([
//            'productName' => $row[0],
//        ]);
//    }


    public function collection(Collection $rows)
    {

        foreach ($rows as $key=>$row) {
            if($key > 0 && $row[1] != null){
                $barcode = $row[1];
                $sku = Sku::where('barcode', $barcode)->first();

               $batch =  Batch::create([
                   'skuId' => $sku->skuId,
                    'vendor' => $row[5],
                    'storeId' => $row[4],
                    'quantity' => $row[3],
                ]);

                Stock::create([
                   'fkskuId' => $sku->skuId,
                    'batchId' => $batch->batchId,
                    'stock' => $row[3],
                    'type' => 'in',
                    'identifier' => 'purchase',
                ]);

            }
        }

//        if($key > 0 && $row[1] == null){
//            dd('fff');
//
//        }
//        else{
//            dd('e');
//        }

        return back();
    }
}
