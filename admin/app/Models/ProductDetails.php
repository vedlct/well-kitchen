<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
    protected $table = 'product_details';
    protected $primaryKey = 'product_detailsId';
    public $timestamps = false;

    protected $fillable = ['fkskuId', 'description', 'fabricDetails', 'productId'];

    public function product(){
        return $this->hasOne('App\Models\Product', 'productId', 'productId');
    }
}
