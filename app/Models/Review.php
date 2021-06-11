<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table='reviews';
    protected $primaryKey='idreviews';

    public function user()
    {
        return $this->hasOne(User::class,'userId','customerID');
    }
}
