<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table ='customer';
    protected $primaryKey='customerId';

    public function order()
    {
        return $this->hasMany('App\Models\Order', 'fkcustomerId', 'customerId');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'userId', 'fkuserId');
        // return $this->hasOne('App\Models\User', 'fkuserId', 'userId');
    }

    public function address()
    {
        return $this->hasOne('App\Models\Address', 'fkcustomerId', 'customerId');
    }

    public function membership()
    {
        return $this->hasMany('App\Models\Membership', 'fkcustomerId', 'customerId');
    }

    public function totalPoint($id)
    {
        return $this->membership()->where('fkcustomerId',$id)->sum('point');
    }

    // public function reviews()
    // {
    //     return $this->hasMany('App\Models\Review','idreviews','customerId');
    // }

    // public function balance()
    // {
    //     return $this->hasMany('App\Models\CustomerBalance', 'customerId', 'customerId');
    // }
}
