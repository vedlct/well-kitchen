<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table='store';
    protected $primaryKey='storeId';

    public function added()
    {
        return $this->hasOne('App\Models\User', 'userId', 'added_by');
    }
}
