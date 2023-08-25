<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Super Admin',
               'email'=>'superadmin@gmail.com',
               'role'=>0,
               'password'=> bcrypt('superadmin@123'),
            ],
            [
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
               'role'=>1,
               'password'=> bcrypt('admin@123'),
            ],
            [
               'name'=>'User',
               'email'=>'user@gmail.com',
               'role'=> 2,
               'password'=> bcrypt('user@123'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
