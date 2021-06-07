<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function show()
    {
        return view('brand.index');
    }

    public function list()
    {
        $brand = Brand::all();

        return datatables()->of($brand)
            ->addColumn('brandLogo', function ($image) {
                if (isset($image->brandLogo)) {
                    return '<img 
                    src="'.url('public/brandLogo/'.$image->brandLogo).'" border="0" class="img-rounded" align="center"
                     />';
                } else {
                    return
                        '<img src="'.url('public/brandLogo/default.png').'" border="0" width="50px" height="30px" class="img-rounded" align="center" />';
                }
            })
            ->addColumn('status', function (Brand $status) {
                if ($status->status == 'active') {
                    return "<span class='badge badge-success'>Active</span>";
                } elseif ($status->status == 'inactive') {
                    return "<label class='badge badge-danger'>Inactive</label>";
                }
            })
            ->rawColumns(['status', 'brandLogo'])
            ->setRowAttr([
                'align' => 'center',
            ])->make(true);
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'brandName' => 'required|unique:brand',
        ]);

        $brand = new Brand();
        $brand->brandName = $request->brandName;
        $brand->status = $request->status;
        $brand->save();

        if ($request->hasFile('brandLogo')) {
            $originalName = $request->brandLogo->getClientOriginalName();
            $uniqueImageName = $request->brandName.$originalName;
            $image = Image::make($request->brandLogo);
            $image->resize(180, 50);
            $image->save(public_path().'/brandLogo/'.$uniqueImageName);
            $brand->brandLogo = $uniqueImageName;
            $brand->save();
        }
        Session::flash('success', 'Brand Created Successfully');

        return redirect()->route('brand.show');
    }

    public function edit($brandId)
    {
        $brand = Brand::where('brandId', $brandId)->first();

        return view('brand.edit', compact('brand'));
    }

    public function update(Request $request, $brandId)
    {
        $this->validate($request, [
            'brandName' => 'required|unique:brand,brandId',
        ]);

        $brand = Brand::where('brandId', $brandId)->first();
        $brand->brandName = $request->brandName;
        $brand->status = $request->status;
        $brand->save();

        if ($request->hasFile('brandLogo')) {
            $originalName = $request->brandLogo->getClientOriginalName();
            $uniqueImageName = $request->brandName.$originalName;
            $file_path = public_path().'/brandLogo/'.$brand->brandLogo;
            File::delete($file_path);
            $image = Image::make($request->brandLogo);
            $image->resize(180, 50);
            $image->save(public_path().'/brandLogo/'.$uniqueImageName);
            $brand->brandLogo = $uniqueImageName;
            $brand->save();
        }
        Session::flash('success', 'Brand Updated Successfully');

        return redirect()->route('brand.show');
    }

    public function delete(Request $request)
    {
        $brand = Brand::where('brandId', $request->brandId)->first();
        $file_path = public_path().'/brandLogo/'.$brand->brandLogo;
        File::delete($file_path);
        $brand->delete();

        return response()->json();
    }
}
