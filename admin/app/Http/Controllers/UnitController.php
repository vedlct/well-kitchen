<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Session;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    public function show()
    {
        return view('unit.index');
    }
    public function list()
    {
        $unit = Unit::all();
        return datatables()->of($unit)
            ->setRowAttr([
                'align'=>'center',
            ])->make(true);
    }

    public function create(){
        return view('unit.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'product_unitName' => 'required|unique:unit'
        ]);

        $unit = new Unit();
        $unit->product_unitName = $request->product_unitName;
        $unit->save();

        Session::flash('success', 'Unit Created Successfully');
        return redirect()->route('unit.show');
    }

    public function edit($idproduct_unit){
        $unit =Unit::where('idproduct_unit', $idproduct_unit)->first();
        return view('unit.edit', compact( 'unit'));
    }

    public function update(Request $request, $idproduct_unit){
        $this->validate($request, [
            'product_unitName' => 'required|unique:unit,idproduct_unit'
        ]);

        $unit = Unit::where('idproduct_unit', $idproduct_unit)->first();
        $unit->product_unitName = $request->product_unitName;
        $unit->save();

        Session::flash('success', 'Unit Updated Successfully');
        return redirect()->route('unit.show');
    }

    public function delete(Request $request){
        $unit = Unit::where('idproduct_unit', $request->idproduct_unit)->first();
        $unit->delete();
        return response()->json();

    }
}
