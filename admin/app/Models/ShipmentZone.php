<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentZone extends Model
{
    use HasFactory;
    protected $table ='shipment_zone';
    protected $primaryKey='shipment_zoneId';
    public $timestamps = false;

    public function charges()
    {
        return $this->hasOne('App\Models\Charges', 'fkshipment_zoneId', 'shipment_zoneId');
    }
}
