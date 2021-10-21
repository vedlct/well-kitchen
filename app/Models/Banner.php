<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table ='banner';
    protected $primaryKey='bannerId';
    public $timestamps = false;

    public function promotion()
    {
        return $this->hasOne('App\Models\Promotion', 'promotionsId', 'fkPromotionId');
    }
}
