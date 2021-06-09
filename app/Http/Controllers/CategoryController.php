<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryProducts($categoryId){
        return view('shop');
    }
}
