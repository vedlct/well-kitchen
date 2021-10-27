<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Testimonial;
use Image;


class TestimonialController extends Controller
{
    public function show()
    {
        return view('testimonial.index');
    }
    public function list()
    {
        $testimonial = Testimonial::all();
        return datatables()->of($testimonial)
            ->setRowAttr([
                'align'=>'center',
            ])->make(true);
    }

    public function create(){
        return view('testimonial.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:testimonial',
            // 'details' => 'required|unique:testimonial',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->details = $request->details;
        $testimonial->status = $request->status;
        $testimonial->home = $request->home;
        $testimonial->save();

        if ($request->hasFile('imageLink')) {
            $originalName = $request->imageLink->getClientOriginalName();
            $uniqueImageName =  $testimonial->name.$originalName;
            $image = Image::make($request->imageLink);
            $image->resize(280, 280);
            $image->save(public_path().'/testimonialImage/'.$uniqueImageName);
            $testimonial->imageLink = $uniqueImageName;
            $testimonial->save();
        }

        Session::flash('success', 'testimonial Created Successfully');
        return redirect()->route('testimonial.show');
    }

    public function edit($testimonial_id){
        $testimonial =Testimonial::where('testimonial_id', $testimonial_id)->first();
        return view('testimonial.edit', compact( 'testimonial'));
    }

    public function update(Request $request, $testimonial_id){
        $this->validate($request, [
            'name' => 'required|unique:testimonial,testimonial_id'
        ]);

        $testimonial = Testimonial::where('testimonial_id', $testimonial_id)->first();
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->details = $request->details;
        $testimonial->status = $request->status;
        $testimonial->home = $request->home;
        $testimonial->save();

        if ($request->hasFile('imageLink')) {
            $originalName = $request->imageLink->getClientOriginalName();
            $uniqueImageName =  $testimonial->name.$originalName;
            $image = Image::make($request->imageLink);
            $image->resize(280, 280);
            $image->save(public_path().'/testimonialImage/'.$uniqueImageName);
            $testimonial->imageLink = $uniqueImageName;
            $testimonial->save();
        }

        Session::flash('success', 'Testimonial Updated Successfully');
        return redirect()->route('testimonial.show');
    }

    public function delete(Request $request){
        $testimonial = Testimonial::where('testimonial_id', $request->testimonial_id)->first();
        $testimonial->delete();
        return response()->json();

    }
}
