<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    public function permission()
    {
        return $this->hasMany(RolePermission::class);
    }
    public function allPermission()
    {
        $permissions = $this->permission;
        $allPermission = array();
        foreach ($permissions as $permission) {
            foreach ($permission->permission as $per) {
                array_push($allPermission, $per);
            }
        }
        return array_unique($allPermission);
    }
    use HasFactory;
}
