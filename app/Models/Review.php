<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table='reviews';
    protected $primaryKey='idreviews';

    public function customer()
    {
        return $this->hasOne('App\Models\Customer','customerId','idreviews');
    }
}
