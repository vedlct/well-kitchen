<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index($id)
    {
        $page=Page::findOrfail($id);
        return view('page',compact('page'));
    }
}
