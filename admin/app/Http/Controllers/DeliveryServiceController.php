<?php

namespace App\Http\Controllers;

use App\Models\DeliveryService;
use Illuminate\Http\Request;
use Session;

class DeliveryServiceController extends Controller
{
    public function index()
    {
        return view('deliveryService.index');
    }

    public function list(Request $request)
    {
        $deliveryService=DeliveryService::all();
        return datatables()->of($deliveryService)->setRowAttr([
            'align'=>'center',
        ])-> make(true);
    }

    public function create()
    {
        return view('deliveryService.add');
    }

    public function store(Request $r)
    {
        $r->validate([

        ]);

        $deliveryService=new DeliveryService();
        $deliveryService->companyName=$r->companyName;
        $deliveryService->phone=$r->phone;
        $deliveryService->location=$r->location;
        $deliveryService->delivery_type=$r->delivery_type;
        $deliveryService->save();
        return redirect()->route('deliveryService.index');
    }

    public function edit($deliveryServiceId){
        $deliveryService = DeliveryService::where('deliveryServiceId', $deliveryServiceId)->first();
        return view('deliveryService.edit', compact('deliveryService'));
    }

    public function update(Request $r, $deliveryServiceId){
        $r->validate([

        ]);
        $deliveryService = DeliveryService::where('deliveryServiceId', $deliveryServiceId)->first();
        $deliveryService->companyName=$r->companyName;
        $deliveryService->phone=$r->phone;
        $deliveryService->location=$r->location;
        $deliveryService->delivery_type=$r->delivery_type;
        $deliveryService->save();

        Session::flash('success', 'Delivery Service Updated Successfully');
        return redirect()->route('deliveryService.index');
    }

    public function delete(Request $request){
        $deliveryService = DeliveryService::where('deliveryServiceId', $request->deliveryServiceId)->first();
        $deliveryService->delete();

        Session::flash('success', 'Delivery Service Deleted Successfully');
        return redirect()->route('deliveryService.index');

    }

}
