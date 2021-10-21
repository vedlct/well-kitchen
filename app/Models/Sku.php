<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;
    protected $table='sku';
    protected $primaryKey='skuId';

    public function stockRecord()
    {
        return $this->hasMany('App\Models\Stock', 'fkskuId', 'skuId');
    }

    public function batches()
    {
        return $this->hasMany('App\Models\Batch', 'skuId', 'skuId');
    }

    public function variationRelation()
    {
        return $this->hasMany('App\Models\VariationDetails', 'skuId', 'skuId');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'productId', 'fkproductId');
    }

    public function variationImages(){

        return $this->hasMany('App\Models\ProductImages', 'fkskuId', 'skuId');
    }

//    public function variationImage(){
//        return $this->hasOne('App\Models\ProductImages', 'fkskuId', 'skuId');
//    }
}
