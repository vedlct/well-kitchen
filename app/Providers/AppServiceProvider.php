<?php

namespace App\Providers;

use App\Models\Category;
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
        view()->share(['allCategories'=>$allCategories, 'subCategories'=>$subCategories, 'subSubCategories'=>$subSubCategories]);
    }
}
