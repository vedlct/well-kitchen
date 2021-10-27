<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use datatables;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        return view('vendor.index');
    }

    public function vendorLsit(Request $request)
    {
        return datatables()->of(Vendor::all())
            ->addColumn('status', function ($vendor) {
                if ($vendor->status == 'Active') {
                    return '<label class="btn btn-success">Active</label>';
                } elseif ($vendor->status == 'inactive') {
                    return '<label class="btn btn-danger">Inactive</label>';
                }
            })
            ->addColumn('action', function ($action) {
                return '
                <div class="dropdown ">
                    <a class="btn btn-warning btn-sm dropdown-toggle"role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a data-panel-id="'.$action->vendor_id.'" onclick="vdetails(this)" title="View" class="dropdown-item"><i class="fa fa-eye"></i> View</a>
                        <a data-panel-id="'.$action->vendor_id.'" onclick="editVendor(this)" title="Edit" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                        <a title="Delete" class="dropdown-item text-danger" data-panel-id="'.$action->vendor_id.'" onclick="deleteVendor(this)"><i class="fa fa-trash"></i> Delete</a>
                   </div>
                </div>
                ';
            })
            ->rawColumns(['action', 'status'])
            ->setRowAttr([
                'align' => 'center',
                'height' => '50%',
            ])->make(true);
    }

    public function createVendor()
    {
        return view('vendor.add');
    }

    public function vendorStore(Request $r)
    {
        $this->validate($r, [
            'vendor_firstName' => 'required',
            'vendor_phone' => 'required|digits:11',
            'vendor_lastName' => 'required',
        ]);
        
        if($r->vendorId){
            $vendor = vendor::find($r->vendorId);
        }
        else{
            $vendor = new vendor();
        }
        $vendor->vendor_firstName = $r->vendor_firstName;
        $vendor->vendor_lastName = $r->vendor_lastName;
        $vendor->vendor_phone = $r->vendor_phone;
        $vendor->vendor_shop_name = $r->vendor_shop_name;
        $vendor->status = 'Active';
        $vendor->save();

        return redirect()->route('vendor.index')->with('success', 'Vendor created successfully');
    }

    public function vendorDelete(Request $r)
    {
        $vendor = Vendor::findOrFail($r->vendor_id);
        $vendor->delete();

        return redirect()->route('vendor.index')->with('success', true);
    }

    public function vendorEdit(Request $r)
    {
        $vendor = vendor::find($r->id);

        return view('vendor.add', compact('vendor'));
    }

    public function vendorUpdate(Request $r)
    {
        $this->validate($r, [
            'vendor_firstName' => 'required',
            'vendor_phone' => 'required|digits:11',
            'vendor_lastName' => 'required',
        ]);

        $vendor = vendor::find($r->id);
        $vendor->vendor_firstName = $r->vendor_firstName;
        $vendor->vendor_lastName = $r->vendor_lastName;
        $vendor->vendor_phone = $r->vendor_phone;
        $vendor->vendor_shop_name = $r->vendor_shop_name;
        $vendor->status = 'Active';
        $vendor->save();

        return redirect()->route('vendor.index')->with('success', true);
    }
}
