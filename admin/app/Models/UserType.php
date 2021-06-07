<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $table='user_type';
    protected $primaryKey='userTypeId';
    public $timestamps = false;

    protected $fillable = [
        'typeName'
    ];
    // public function permission()
    // {
    //     return $this->hasMany('App\Model\RolePermission', 'role_id', 'userTypeId');
    // }
}
