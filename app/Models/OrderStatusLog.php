<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    use HasFactory;

    protected $table ='order_log';
    protected $primaryKey='status_log_id';

    public function author()
    {
        return $this->hasOne('App\Models\User', 'userId', 'addedBy');
    }

    public function order()
    {
        return $this->hasOne('App\Models\Order', 'orderId', 'order_id');
    }
}
