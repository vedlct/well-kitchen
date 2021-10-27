<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoProduct extends Model
{
    use HasFactory;
    protected $table ='promotion_product';
    protected $primaryKey='promotion_productID';
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'productId', 'fkproductId');
    }
}
