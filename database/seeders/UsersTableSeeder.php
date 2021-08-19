<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'nohp' => '0812345',
            'password' => bcrypt('password'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'User',
            'email' => 'cek@mail.com',
            'nohp' => '089691030555',
            'password' => bcrypt('password'),
            'role_id' => 3
        ]);
    }
}
