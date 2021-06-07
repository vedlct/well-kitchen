<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\Page;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Session;
use File;

class PageController extends Controller
{

    public function index()
    {
        return view('page.index');
    }

    public function pageList()
    {
        return datatables()->of(Page::get())
            ->addColumn('imageData', function ($image) {
                if (isset($image->image) && file_exists(public_path('pageImage/'.$image->image))){
                    return '<img src="'.url('public/pageImage/'.$image->image).'" border="0" height="50" class="img-rounded" align="center" />';
                }else{
                    return 'No image';
                }
            })
            ->addColumn('statusField', function($status) {
                if($status->status == "active"){
                    return "<label class='btn btn-success btn-sm'>Active</label>";
                }elseif($status->status == "inactive"){
                    return "<label class='btn btn-danger btn-sm'>Inactive</label>";
                }
            })
            ->rawColumns(['imageData','statusField'])->make(true);
    }

    public function add()
    {
        return view('page.add');
    }

    public function store(Request $r)
    {
        $rules = [
            'pageTitle' => 'required|min:5',
            'status' => 'required',
            'details' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2041',
        ];
        $this->validate($r, $rules);

        // if ($r->pageId){
        //     $page = Page::find($r->pageId);
        // }else{
            $page = new Page();
        // }
        $page->pageTitle = $r->pageTitle;
        $page->details = $r->details;
        $page->status = $r->status;
        $page->save();

        if($r->hasFile('image')){
            $img = $r->file('image');
            $filename= $page->pageId.'pageImage'.'.'.$img->getClientOriginalExtension();
            $page->image=$filename;
            $location = public_path('pageImage/'.$filename);
            Image::make($img)->save($location);
        }
        $page->save();
        return redirect()->route('page.index');
    }

    public function edit($pageId){
        $page =Page::where('pageId', $pageId)->first();
         return view('page.edit', compact('page'));
    
    }

    public function update(Request $r, $pageId){
        $r->validate([
            'pageTitle' => 'required|min:5',
        ]);

        $page = Page::where('pageId', $pageId)->first();
        $page->pageTitle = $r->pageTitle;
        $page->details = $r->details;
        $page->status = $r->status;
        $page->save();

        if ($r->hasFile('image')) {
            $originalName = $r->image->getClientOriginalName();
            $uniqueImageName = $r->categoryName.$originalName;
            $file_path = public_path().'/pageImage/'.$page->image;
            File::delete($file_path);
            $image = Image::make($r->image);
            $image->resize(280, 280);
            $image->save(public_path().'/pageImage/'.$uniqueImageName);
            $page->image = $uniqueImageName;
            $page->save();
        }
        Session::flash('success', 'Menu Updated Successfully');
        return redirect()->route('page.index');
    }
}
