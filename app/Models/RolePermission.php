<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $guarded = [];
    public function permission()
    {
        return $this->hasMany(Permission::class,'id','permission_id');
    }
    use HasFactory;
}
