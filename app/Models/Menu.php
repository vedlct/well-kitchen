<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table="menu";
    protected $primaryKey="menuId";

    public function page()
    {
        return $this->hasOne('App\Models\Page', 'pageId', 'fkpageId');
    }
}
