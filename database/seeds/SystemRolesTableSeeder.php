<?php

use Illuminate\Database\Seeder;
use Porteiro\Models\Role;

class SystemRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->delete();

        Role::create([
            'name'   => 'user'
        ]);

        Role::create([
            'name'   => 'administrator'
        ]);



        if (!Role::where('name', 'member')->first()) {
            Role::create([
                'name' => 'member',
                'label' => 'Member',
                'permissions' => 'regular',
            ]);
            Role::create([
                'name' => 'admin',
                'label' => 'Admin',
                'permissions' => 'admin,siravel,regular',
            ]);
            Role::create([
                'name' => 'siravel',
                'label' => 'Siravel',
                'permissions' => 'siravel,regular',
            ]);
        }
    }
}
