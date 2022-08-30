<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolePermission::create([
            'id'=>1,
            'role_id'=>1,
            'permission_id'=>1,
            'created_by'=>1
        ]);
    }
}
