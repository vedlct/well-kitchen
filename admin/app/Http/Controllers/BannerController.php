<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Image;
Use File;
use Session;

class BannerController extends Controller
{
    public function index(){
        return view('banner.index');
    }

//    public function add(){
//        return view('banner.add_banner');
//    }
//
//    public function insert(Request $r){
//        $rules= [
//            'imageLink' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
//            'status' => 'required',
//            'type' => 'required'
//        ];
//
//        $this->validate($r, $rules);
//
//        $banner = new Banner();
//        $banner->status = $r->status;
//        $banner->type = $r->type;
//        $banner->save();
//        if($r->hasFile('imageLink')){
//            $img = $r->file('imageLink');
//            $filename= $banner->bannerId.'bannerImage'.'.'.$img->getClientOriginalExtension();
//            $banner->imageLink=$filename;
//            $location = public_path('bannerImage/'.$filename);
//            Image::make($img)->save($location);
//        }
//        $banner->save();
//        return redirect()->route('banner');
//    }

    public function showBanner(){
        return datatables()->of(Banner::all())
            ->addColumn('status', function (Banner $status){
                if ($status->status == "Active") {
                    return "<label style='width: auto' class='btn btn-success btn-sm'>Active</label>";
                } elseif ($status->status == "Inactive") {
                    return "<label class='btn btn-danger btn-sm'>Inactive</label>";
                }
            })
            ->addColumn('image', function ($image) {
                if (isset($image->imageLink)){
                    return '<img src="'.url('public/bannerImage/'.$image->imageLink).'" border="0" height="50" width="220" class="img-rounded" align="center" />';
                }else{
                    return 'No image';
                }
            })
            ->rawColumns(['image','status'])
            ->make(true);
    }

    public function create(){
        $banner = Banner::all();
        $promotion=Promotion::where('status','active')->get();
        return view('banner.create', compact('banner','promotion'));
    }

   

    public function store(Request $r){
        // $this->validate($request, [
        //    'categoryName' => 'required|unique:category'
        // ]);
        $rules= [
                       'imageLink' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                       'status' => 'required',
                    //    'type' => 'required'
                   ];
            
                   $this->validate($r, $rules);

       $banner = new Banner();
       $banner->status = $r->status;
       $banner->type = $r->type;
       if (isset($r->promotion)) {
           $banner->fkPromotionId=$r->promotion;
       }
       $banner->save();
       if($r->hasFile('imageLink')){
           $img = $r->file('imageLink');
           $filename= $banner->bannerId.'bannerImage'.'.'.$img->getClientOriginalExtension();
           $banner->imageLink=$filename;
           $location = public_path('bannerImage/'.$filename);
           Image::make($img)->save($location);
       }
       $banner->save();
       Session::flash('success', 'Banner Created Successfully');
       return redirect()->route('banner.show');

    }

    public function edit($id){
        $banner=Banner::findOrFail($id);
        $promotion=Promotion::where('status','active')->get();
        return view('banner.edit',compact('banner','promotion'));
    }

    public function update(Request $r){
        if(!$r->previousImage){
            $this->validate($r, [
                'imageLink' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
            ]);
        }
        $this->validate($r, [
            'imageLink' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required'
        ]);

        $banner = Banner::find($r->id);
        $banner->status = $r->status;
        if (isset($r->promotion)) {
            $banner->fkPromotionId=$r->promotion;
        }
        if (isset($r->promotion)) {
            $banner->fkPromotionId=$r->promotion;
        }
        $banner->save();
        if($r->hasFile('imageLink')){
            if($r->previousImage && !empty($r->previousImage) && file_exists(public_path('bannerImage/'.$r->previousImage))){
                unlink(public_path('bannerImage/'.$r->previousImage));
            }
            $img = $r->file('imageLink');
            $filename= $banner->bannerId.'bannerImage'.'.'.$img->getClientOriginalExtension();
            $location = public_path('bannerImage/'.$filename);
            $uploadImage = Image::make($img);
            if($r->type == "Header"){
                $uploadImage = $uploadImage->resize(1920, 221);
            }elseif($r->type == "Hot Deals"){
                $uploadImage = $uploadImage->resize(1169, 60);
            }elseif($r->type == "Footer_1" || $r->type == "Footer_2"){
                $uploadImage = $uploadImage->resize(580, 189);
            }
            $uploadImage->save($location);
            $banner->imageLink=$filename;
            $banner->save();
        }

        Session::flash('success', 'Brand Updated Successfully');
        return redirect()->route('banner.show');
        // return redirect('banner.show')->with('success', true);
    }

    // public function delete(Request $r){
    //     $banner = Banner::find($r->bannerId);
    //     if(!empty($banner->imageLink) && file_exists(public_path('bannerImage/'.$banner->imageLink))){
    //         unlink(public_path('bannerImage/'.$banner->imageLink));
    //     }
    //     $banner->imageLink = null;
    //     $banner->save();
    //     return redirect()->route('banner.show')->with('success', true);

    // }

    public function delete(Request $request){
        $banner = Banner::where('bannerId', $request->bannerId)->first();
        $file_path = public_path().'/bannerImage/'.$banner->imageLink;
        File::delete($file_path);
        $banner->delete();

        Session::flash('success', 'Brand Deleted Successfully');
        return response()->json();

    }
}
