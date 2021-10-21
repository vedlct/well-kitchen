<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;
use Session; 


class MenuController extends Controller
{
    public function index()
    {
        return view('menu.index');
    }

    public function list(Request $request)
    {
        $menu=Menu::all();
        return datatables()->of($menu)->setRowAttr([
         'align'=>'center',
        ])-> make(true);
    }

    public function add()
    {
        $page=Page::get();
        return view('menu.add',compact('page'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'MenuOrder' => 'required|unique:menu|max:255',
            'MenuType' => 'required|max:255',
            'fkpageId' => 'required|max:255'
        ]);

        $menu=new Menu();
        $menu->menuName=$r->MenuName;
        $menu->menuOrder=$r->MenuOrder;
        $menu->MenuType=$r->MenuType;
        $menu->parent=$r->parent;
        $menu->fkpageId=$r->fkpageId;
        $menu->save();
        if($r->hasFile('imageLink')){
            $img = $r->file('imageLink');
            $filename= $menu->menuId.'_menuImage'.'.'.$img->getClientOriginalExtension();
            $menu->imageLink=$filename;
            $location = public_path('menuImage/'.$filename);
            Image::make($img)->save($location);
        }
        $menu->save();

        return redirect()->route('menu.index');
    }

    public function edit($menuId){
       
        $menu =Menu::where('menuId', $menuId)->first();
        $page=Page::get();
        return view('menu.edit', compact('menu','page'));
    }

    public function update(Request $r, $menuId){
        $r->validate([
            'MenuOrder' => 'required|max:255',
            'MenuType' => 'required|max:255',
            'fkpageId' => 'required|max:255'
        ]);
        $menu = Menu::where('menuId', $menuId)->first();
        $menu->menuName=$r->MenuName;
        $menu->menuOrder=$r->MenuOrder;
        $menu->MenuType=$r->MenuType;
        $menu->parent=$r->parent;
        $menu->fkpageId=$r->fkpageId;
        $menu->save();

        if ($r->hasFile('imageLink')) {
            $originalName = $r->imageLink->getClientOriginalName();
            $uniqueImageName = $r->categoryName.$originalName;
            $file_path = public_path().'/menuImage/'.$menu->imageLink;
            File::delete($file_path);
            $image = Image::make($r->imageLink);
            $image->resize(280, 280);
            $image->save(public_path().'/menuImage/'.$uniqueImageName);
            $menu->imageLink = $uniqueImageName;
            $menu->save();
        }
        Session::flash('success', 'Menu Updated Successfully');
        return redirect()->route('menu.index');
    }

    public function delete(Request $request){
        $menu = Menu::where('menuId', $request->menuId)->first();
        $file_path = public_path().'/menuImage/'.$menu->imageLink;
        File::delete($file_path);
        $menu->delete();

        Session::flash('success', 'Menu Updated Successfully');
        return redirect()->route('menu.index');

    }
    
}
