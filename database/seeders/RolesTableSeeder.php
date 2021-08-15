<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_role = [
            'Super Admin',
            'Admin',
            'Member'
        ];

        foreach($list_role as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
