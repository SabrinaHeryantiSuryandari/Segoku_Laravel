<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'role'=>'admin',
                'password'=>bcrypt('admin123')
            ],
            [
                'name'=>'user',
                'email'=>'user@user.com',
                'role'=>'user',
                'password'=>bcrypt('user123')
            ],
        ];
        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
