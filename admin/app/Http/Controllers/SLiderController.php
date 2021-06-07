<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use datatables;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SLiderController extends Controller
{
    public function index()
    {
        return view('slider.index');
    }

    public function List(Request $request)
    {
        $slider = Slider::all();

        return datatables()->of($slider)
                ->addColumn('image', function ($slider) {
                    if (!empty($slider->imageLink)) {
                        $url = asset('public/sliderImage/'.$slider->imageLink);

                        return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                    } else {
                        return 'No image';
                    }
                })
                ->rawColumns(['image'])
                ->setRowAttr([
                    'align' => 'center',
                    'height' => '50%',
                ])->make(true);
    }

    public function add()
    {
        return view('slider.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'mainText' => 'required',
            // 'subText' => 'required',
            'status' => 'required',
            'sliderImage' => 'image|required_if:sliderId,null',
        ]);
        if (isset($request->sliderId)) {
            $slider = Slider::findOrfail($request->sliderId);
        } else {
            $slider = new Slider();
        }
        $slider->mainText = $request->mainText;
        $slider->subText = $request->subText;
        $slider->status = $request->status;
        $slider->save();
        if ($request->hasFile('sliderImage')) {
            $img = $request->file('sliderImage');
            $filename = date('dhs').rand(10, 10000).'.'.$img->getClientOriginalExtension();
            $slider->imageLink = $filename;
            $location = public_path('sliderImage/'.$filename);
            Image::make($img)->save($location);
            $slider->save();
        }

        return redirect()->route('slider.index');
    }

    public function edit($id)
    {
        $slider = Slider::findOrfail($id);

        return view('slider.edit', compact('slider'));
    }
}
