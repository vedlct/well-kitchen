<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.index');
    }

    public function StoreList(Request $request)
    {
        $store = Store::query()->with(['added']);
        return DataTables::eloquent($store)
            ->orderColumn('storeId', '-storeId $1')
            ->addColumn('action', function($action) {
                return '
                <div class="dropdown ">
                    <a class="btn btn-warning btn-sm dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a href="javascript:void(0)" onclick="editStore('.$action->storeId.')" title="Edit" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                   </div>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('store.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:20',
            'location' => 'required'
        ]);

        if($request->storeId){
            $store = Store::find($request->storeId);
        }else{
            $store = New Store();
        }
        $store->name = $request->name;
        $store->location = $request->location;
        $store->added_by = Auth::user()->userId;
        $store->save();
        return redirect (route('store.index'))->with('success', true);
    }

    public function edit($id)
    {
        $store = Store::find($id);
        return view('store.add',compact('store'));
    }
}
