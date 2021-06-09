<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\ServiceProvider;

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
        
        view()->share(['allCategories'=>$allCategories, 'subCategories'=>$subCategories, 'subSubCategories'=>$subSubCategories, 'menu'=>$menu]);
    }
}
