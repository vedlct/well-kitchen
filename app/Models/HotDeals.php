<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotDeals extends Model
{
    use HasFactory;
    protected $table ='hotdeals';
    protected $primaryKey='hotDealsId';
    public $timestamps = false;
}
