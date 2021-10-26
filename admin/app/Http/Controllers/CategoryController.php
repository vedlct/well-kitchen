<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Datatables;
use Session;
use File;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function show()
    {
        return view('category.index');
    }
    public function list()
    {
        $category = Category::all();
        return datatables()->of($category)
            ->addColumn('image', function($image) {
                if (isset($image->imageLink)){
                    return '<img src="'.url('public/categoryImage/'.$image->imageLink).'" border="0" width="40" class="img-rounded" align="center" />';
                }else{
                    return 'No image';
                }
            })
            ->rawColumns(['image'])
            ->setRowAttr([
                'align'=>'center',
            ])->make(true);
    }

    public function create(){
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    public function checkSubCategory(Request $request){
        $subSubCategories = Category::where('parent', $request->subCategory)->get();
        return response()->json(['subSubCategories' => $subSubCategories]);
    }

    public function store(Request $request){
        $this->validate($request, [
           'categoryName' => 'required|unique:category'
        ]);

        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->parent = $request->parent;
        $category->subParent = $request->subParent;
        $category->homeShow = $request->homeShow;
        $category->save();

        if ($request->hasFile('imageLink')) {
            $originalName = $request->imageLink->getClientOriginalName();
            $uniqueImageName =  $category->categoryName.$originalName;
            $image = Image::make($request->imageLink);
            $image->save(public_path().'/categoryImage/'.$uniqueImageName);
            $category->imageLink = $uniqueImageName;
            $category->save();
        }
        Session::flash('success', 'Category Created Successfully');
        return redirect()->route('category.show');
    }

    public function edit($categoryId){
        $categories = Category::where('categoryId', '!=', $categoryId)->get();
        $category =Category::where('categoryId', $categoryId)->first();
        return view('category.edit', compact('categories', 'category'));
    }

    public function update(Request $request, $categoryId){
        $this->validate($request, [
            'categoryName' => 'required|unique:category,categoryId'
        ]);

        $category = Category::where('categoryId', $categoryId)->first();
        $category->categoryName = $request->categoryName;
        $category->parent = $request->parent;
        $category->subParent = $request->subParent;
        $category->homeShow = $request->homeShow;
        $category->save();

        if ($request->hasFile('imageLink')) {
            $originalName = $request->imageLink->getClientOriginalName();
            $uniqueImageName = $request->categoryName.$originalName;
            $file_path = public_path().'/categoryImage/'.$category->imageLink;
            File::delete($file_path);
            $image = Image::make($request->imageLink);
            $image->save(public_path().'/categoryImage/'.$uniqueImageName);
            $category->imageLink = $uniqueImageName;
            $category->save();
        }
        Session::flash('success', 'Category Updated Successfully');
        return redirect()->route('category.show');
    }

    public function delete(Request $request){
        $category = Category::where('categoryId', $request->categoryId)->first();
        $file_path = public_path().'/categoryImage/'.$category->imageLink;
        File::delete($file_path);
        $category->delete();
        return response()->json();

    }


}
