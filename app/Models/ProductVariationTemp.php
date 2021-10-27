<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationTemp extends Model
{
    use HasFactory;
    protected $table ='product_variation_temp';
    protected $primaryKey='variation_temp_id ';
    public $timestamps = false;
}
