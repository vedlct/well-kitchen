<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meta;
use Session;

class MetaController extends Controller
{
    public function show()
    {
        return view('meta.index');
    }
    public function list()
    {
        $meta = Meta::all();
        return datatables()->of($meta)
            ->setRowAttr([
                'align'=>'center',
            ])->make(true);
    }

    public function create(){
        return view('meta.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'meta_name' => 'required|unique:meta_data'
           
        ]);

        $meta = new Meta();
        $meta->meta_name = $request->meta_name;
        $meta->meta_content = $request->meta_content;
        $meta->save();

        Session::flash('success', 'Meta Created Successfully');
        return redirect()->route('meta.show');
    }

    public function edit($meta_id){
        $meta =Meta::where('meta_id', $meta_id)->first();
        return view('meta.edit', compact('meta'));
    }

    public function update(Request $request, $meta_id){
        $this->validate($request, [
            'meta_name' => 'required|unique:meta_data,meta_id'
        ]);

        $meta = Meta::where('meta_id', $meta_id)->first();
        $meta->meta_name = $request->meta_name;
        $meta->meta_content = $request->meta_content;
        $meta->save();

        Session::flash('success', 'Meta Updated Successfully');
        return redirect()->route('meta.show');
    }

    public function delete(Request $request){
        $meta = Meta::where('meta_id', $request->meta_id)->first();
        $meta->delete();
        return response()->json();

    }
}
