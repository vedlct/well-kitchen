<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Sku;
use http\Env\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('productexport', [
            'allSkus' => collect(DB::select(DB::raw("SELECT sku.skuId, product.productCode, sku.barcode, COALESCE(SUM(CASE WHEN stock_record.type = 'in' THEN stock END), 0) - COALESCE(SUM(CASE WHEN stock_record.type = 'out' THEN stock END), 0) as available FROM stock_record LEFT JOIN sku ON sku.skuId = stock_record.fkskuId LEFT JOIN product ON sku.fkproductId = product.productId GROUP BY sku.skuId "))),
            'skuOpeningStock' => collect(DB::select(DB::raw("SELECT sku.skuId,  COALESCE(CASE WHEN stock_record.type = 'in' THEN stock END) as openingStock FROM stock_record LEFT JOIN sku ON sku.skuId = stock_record.fkskuId LEFT JOIN product ON sku.fkproductId = product.productId GROUP BY sku.skuId "))),
        ]);
    }

}



//    public function collection()
//    {
//         $skus = Sku::with('product')->get();
//         return response()->json(['skus'=>$skus]);
//        return DB::table('sku')
//            ->select('barcode', DB::raw('DISTINCT fkproductId'), 'stock_record.stock')
//            ->leftJoin('product', 'sku.fkproductId', '=', 'product.productId')
//            ->leftJoin('stock_record', 'stock_record.fkskuId', '=', 'sku.skuId')
//            ->get();
//        return collect(DB::select(DB::raw("SELECT sku.skuId, product.productCode, COALESCE(SUM(CASE WHEN stock_record.type = 'in' THEN stock END), 0) - COALESCE(SUM(CASE WHEN stock_record.type = 'out' THEN stock END), 0) as available FROM stock_record LEFT JOIN sku ON sku.skuId = stock_record.fkskuId LEFT JOIN product ON sku.fkproductId = product.productId
//GROUP BY sku.skuId, ORDER BY available DESC")));
//    }
//
//    public function headings(): array
//    {
//        return [
//            'Barcode',
//           'Product Code',
//        ];
//    }
//

