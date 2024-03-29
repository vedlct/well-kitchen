<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'productId';

    protected $fillable = ['productName'];

    public function category(){
        return $this->hasOne('App\Models\Category', 'categoryId', 'categoryId');
    }
    public function brand(){
        return $this->hasOne('App\Models\Brand', 'brandId', 'fkbrandId');
    }
    public function unit(){
        return $this->hasOne('App\Models\Unit', 'idproduct_unit', 'fkidproduct_unit');
    }

    public function sku()
    {
        return $this->hasMany('App\Models\Sku', 'fkproductId', 'productId');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImages', 'fkProductId', 'productId');
    }

     public function details()
     {
         return $this->hasOne('App\Models\ProductDetails', 'productId', 'productId');
     }

}
