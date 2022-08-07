<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@quadque.tech',
            'password' => Hash::make('quadque@2020'),
            'is_admin' => '1'
        ]);

        UserInfo::create([
            "user_id" => $user->id
        ]);

        $user = User::create([
            'name' => 'Zaker Dairy',
            'email' => 'admin@zakerdairyfarm.com',
            'password' => Hash::make('z@kerd@iryf@rm'),
            'is_admin' => '1'
        ]);

        UserInfo::create([
            "user_id" => $user->id
        ]);
    }
}
