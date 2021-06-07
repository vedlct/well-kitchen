<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoImage extends Model
{
    use HasFactory;
    protected $table ='promo_image';
    protected $primaryKey='promo_imageId';
    public $timestamps = false;
}
