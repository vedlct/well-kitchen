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

//class TestExport implements FromView
//{
//    public function view(): View
//    {
//        return view('testexport', [
//            'allSkus' => Sku::with('product')->get()
//        ]);
//    }
//
//}


class TestExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
//         $skus = Sku::with('product')->get();
//         return response()->json(['skus'=>$skus]);
        return DB::table('sku')
            ->select('barcode', 'product.productCode')
            ->leftJoin('product', 'sku.fkproductId', '=', 'product.productId')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Barcode',
           'Product Code',
        ];
    }

}
