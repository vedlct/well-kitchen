<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryBalance extends Model
{
    use HasFactory;
    protected $table ='delivery_service_balence';
    protected $primaryKey='balanceId';
}
