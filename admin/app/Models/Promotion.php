<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table ='promotions';
    protected $primaryKey='promotionsId';
    public $timestamps = false;

    public function promoProduct()
    {
        return $this->hasMany('App\Models\PromoProduct', 'fkpromotionsId', 'promotionsId');
    }

    public function promoImage()
    {
        return $this->hasOne('App\Models\PromoImage', 'fkpromotionsId', 'promotionsId');
    }
}
