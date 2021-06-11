<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomShipping extends Model
{
    protected $table ='custom_shipping';
    protected $primaryKey='custom_shippingId';
    public $timestamps = false;
}
