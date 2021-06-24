<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
    }

    public function import(){
        Excel::import(new ProductImport, request()->file('file'));
//        Excel::import(new ProductImport, url('public/productImport.xlsx'));
        return back();
    }
}
