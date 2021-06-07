<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;
    protected $table='role_permission';
    protected $primaryKey='role_permission_id';
    public $timestamps = false;

    protected $fillable = [
        'role_id', 'permission_id'
    ];

    public function permissionHeader()
    {
        return $this->hasOne('App\Models\PermissionHeader', 'header_id', 'permission_id');
    }
}
