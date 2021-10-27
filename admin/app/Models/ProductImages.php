<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    protected $table ='product_image';
    protected $primaryKey='product_imageId';
    public $timestamps = false;

    public function sku(){
        return $this->hasOne('App\Models\Sku', 'skuId', 'fkskuId');
    }
}
