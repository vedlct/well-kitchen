<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table='reviews';
    protected $primaryKey='idreviews';
    protected $dates = ['created_at', 'updated_at'];

    public function customer()
    {
        return $this->hasOne('App\Models\Customer','customerId','customerID');
    }

    public function product()
    {
        return $this->hasOne('App\Model\Product', 'productId', 'fkproductId');
    }

    public function getRating(){
        return $this->hasOne('App\Models\Rating', 'ratingId','rating');
    }

}
