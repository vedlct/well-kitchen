<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table ='order_item';
    protected $primaryKey='order_itemId';
    public $timestamps = false;

    public function order()
    {
        return $this->hasOne('App\Models\Order', 'orderId', 'fkorderId');
    }

    public function sku()
    {
        return $this->hasOne('App\Models\Sku', 'skuId', 'fkskuId');
    }

    public function batch()
    {
        return $this->hasOne('App\Models\Batch', 'batchId', 'batch_id');
    }
}
