<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table ='order_info';
    protected $primaryKey='orderId';

    public function orderedProduct()
    {
        return $this->hasMany('App\Models\OrderProduct', 'fkorderId', 'orderId');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'customerId', 'fkcustomerId');
    }

    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction', 'fkorderId', 'orderId');
    }

    public function orderStatusLogs()
    {
        return $this->hasMany('App\Models\OrderStatusLog', 'order_id', 'orderId');
    }

    public function delivery()
    {
        return $this->hasOne('App\Models\DeliveryService', 'deliveryServiceId', 'delivery_service');
    }

    public function deliveryBalance()
    {
        return $this->hasOne('App\Models\DeliveryServiceBalance', 'orderId', 'orderId');
    }
    
    public function promo()
    {
        return $this->hasOne('App\Models\Promo','promo_id', 'promoId');
    }

    public function lastStatus()
    {
        return $this->hasOne('App\Models\OrderStatusLog', 'order_id', 'orderId')->where('status','!=',NULL)->orderBy('created_at','desc')->latest();
    }

    public function paidAmount()
    {
        return $this->transaction->where('payment_type','!=','return')->sum('amount');
    }
    protected $casts = [
        'orderTotal' => 'float',
    ];

}
