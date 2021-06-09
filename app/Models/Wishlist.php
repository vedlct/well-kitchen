<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;
    protected $table ='wishlist';
    protected $primaryKey='wishlistId';

    public function product()
    {
        return $this->hasOne('App\Models\Product','productId','fkproductId');
     
    }
}
