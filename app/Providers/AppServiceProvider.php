<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Coded By Naiem
        $allCategories = Category::where('parent', null)->get();
        $subCategories = Category::where('parent', '!=', null)->where('subParent', null)->get();
        $subSubCategories = Category::where('parent', '!=', null)->where('subParent', '!=', null)->get();
        $menu=Menu::all();
        $setting = Settings::first();
        if(Auth::check()){
            $user = User::where('userId', Auth::user()->userId)->with('userType')->first();
            view()->share(['allCategories'=>$allCategories, 'subCategories'=>$subCategories, 'subSubCategories'=>$subSubCategories, 'menu'=>$menu, 'user'=>$user, 'setting'=> $setting]);
        }
        view()->share(['allCategories'=>$allCategories, 'subCategories'=>$subCategories, 'subSubCategories'=>$subSubCategories, 'menu'=>$menu, 'setting'=> $setting]);
    }
}
