<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // protected $fillable = [
    //     'fullname',
    //     'email',
    //     'email_verified_at',
    //     'password',
    //     'job_title',
    //     'count',
    //     'photo',
    //     'islock',
    //     'lock_until',
    //     'token',
    //     'expiresIn',
    //     'refreshToken','social_id'
    // ];
    public function role()
    {
        return $this->hasMany(UserRole::class);
    }
    public function allRole()
    {
        $roles = $this->role;
        $allRole = array();
        foreach ($roles as $role) {
            array_push($allRole, $role->role);
        }
        return array_unique($allRole);
    }
    public function allPermission()
    {
        $roles = $this->role;
        $allPermission = array();
        foreach ($roles as $role) {
            foreach ($role->role->allPermission() as $permission) {
                array_push($allPermission, $permission);
            }
        }
        return array_unique($allPermission);
    }
    public function getPhoto(int $version)
    {
        return str_replace("/3/", "/" . $version . "/", $this->photo);
    }
    protected $guarded = [];
    use HasFactory, SoftDeletes;
}
