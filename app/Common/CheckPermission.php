<?php

namespace App\Common;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;

class CheckPermission
{
    public static function hasRole(User $user,String $accessPermission)
    {
        $persmissions = explode(", ", $accessPermission);
        foreach ($user->allPermission() as $persmission) {
            foreach($persmissions as $searchPermission){
                if(in_array($searchPermission,explode(", ",$persmission->code))){
                    return true;
                }
            }
        }
        return false;
    }
}
