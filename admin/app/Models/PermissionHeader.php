<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionHeader extends Model
{
    use HasFactory;
    protected $table='permission_header';
    protected $primaryKey='header_id';
}
