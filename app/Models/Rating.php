<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table ='rating';
    protected $primaryKey='ratingId';
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne('App\Model\Product', 'productId', 'fkproductId');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'customerId', 'fkcustomerId');
    }
    
    // public function reviews()
    // {
    //     return $this->hasMany('App\Models\Review', 'idreviews', 'rating');
    // }
}
