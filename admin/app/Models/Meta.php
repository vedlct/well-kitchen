<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'meta_data';
    protected $primaryKey = 'meta_id';
    public $timestamps = false;
}
