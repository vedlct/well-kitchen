<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipmentZone;
use App\Models\Charges;
use App\Models\CustomShipping;

class ShipmentController extends Controller
{
    public function index()
    {
        return view('shipping.index');
    }


    public function create($shippingID = false)
    {
        if($shippingID){
            $shippingData = ShipmentZone::with('charges','customShipping')->find($shippingID);
            return view('shipping.add',compact('shippingData'));
        }else{
            return view('shipping.add');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ShippingName' => 'required',
            'shippingFee' => 'numeric|min:0',
        ]);

        if($request->zoneID){
            $shipmentZone = ShipmentZone::find($request->zoneID);
            $charges = $shipmentZone->charges;
            $customShipping = $shipmentZone->customShipping;
        }else{
            $shipmentZone = new ShipmentZone();
            $charges = new Charges();
            $customShipping = new CustomShipping();
        }

        $shipmentZone->shipment_zoneName=$request->ShippingName;
        $shipmentZone->save();

        $charges->deliveryFee=$request->shippingFee;
        $charges->fkshipment_zoneId=$shipmentZone->shipment_zoneId;
        $charges->save();

        $customShipping->delivaryFee=$request->shippingFee;
        $customShipping->fkshipment_zoneId=$shipmentZone->shipment_zoneId;
        $customShipping->save();

        return redirect()->route('shipping.index');
    }

    public function show()
    {
        return view('shipping.index');
    }

    public function edit($id)
    {
        return $this->create($id);
    }

    public function shippingChangeStatus(Request $data)
    {
      $shipmentZone = ShipmentZone::find($data->shippingId);
      if ($shipmentZone->status == 'active'){
          $shipmentZone->status = 'inactive';
      }elseif ($shipmentZone->status == 'inactive'){
          $shipmentZone->status = 'active';
      }
      $shipmentZone->save();
    }

    public function list()
    {
        $shipmentZone=ShipmentZone::with(['charges','customShipping'])->get();
        return datatables()->of($shipmentZone)
        ->addColumn('ChargesDeliveryFee', function($data){
            return $data->charges->deliveryFee;
        })
        ->addColumn('statusField', function($status) {
            if($status->status == "active"){
                return "<label class='btn btn-success btn-sm'>Active</label>";
            }elseif($status->status == "inactive"){
                return "<label class='btn btn-danger btn-sm'>Inactive</label>";
            }
        })
//        ->addColumn('CustomShippingDeliveryFee', function($customShipping){
//            return $customShipping->customShipping->delivaryfee;
//        })
        ->rawColumns(['statusField'])->make(true);
    }
}
