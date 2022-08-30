<?php

namespace Database\Seeders;

use App\Common\Permission\Permissions;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'id'=>1,
            'code'=>Permissions::$admin,
            'descryption'=> 'user can do everthing! have full access!',
            'created_by'=>1
        ]);

        foreach(Permissions::$user as $key => $per){
            Permission::create([
                'code' => explode(", ",$per)[1],
                'descryption'=> 'user can '.$key.' User!',
                'created_by'=>1
            ]);
        }
        foreach(Permissions::$role as $key => $per){
            Permission::create([
                'code' => explode(", ",$per)[1],
                'descryption'=> 'user can '.$key.' Role!',
                'created_by'=>1
            ]);
        }
        
      
    }
}
