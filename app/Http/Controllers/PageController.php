<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index($slug)
    {
        $page=Page::where('slug', $slug)->first();
        return view('page',compact('page'));
    }
}
