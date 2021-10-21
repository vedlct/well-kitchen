<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationDetails extends Model
{
    use HasFactory;
    protected $table ='variationrelation';
    protected $primaryKey='variationRelationId';
    public $timestamps = false;

    public function variationDetailsdata()
    {
        return $this->hasOne('App\Models\Variation', 'variationId', 'variationData');
    }
}
