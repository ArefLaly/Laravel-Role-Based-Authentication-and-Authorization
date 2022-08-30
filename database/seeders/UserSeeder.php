<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'=>1,
            'fullname' =>'admin',
            'email' => 'admin@123',
            'email_verified_at' => now(),
            'password' =>bcrypt('admin@123'),
            'job_title' => 'admin',
            'photo' =>'includes/img/users/3/admin.png'
        ]);
    }
}
