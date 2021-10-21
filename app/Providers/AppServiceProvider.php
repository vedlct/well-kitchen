<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Settings;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        $setting = Settings::first();

        view()->composer('*', function ($view) {
            $wishlist = 0;
            if(Auth::user()) {
                $customerId = Customer::where('fkuserId', Auth::user()->userId)->pluck('customerId')->first();
            $wishlist += Wishlist::where('fkcustomerId', $customerId)->count();
            }
            $view->with('wishlist', $wishlist);
    });
        
        view()->share(['allCategories'=>$allCategories, 'subCategories'=>$subCategories, 'subSubCategories'=>$subSubCategories, 'menu'=>$menu, 'setting'=> $setting]);
    }
}
