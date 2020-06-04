<?php

use Illuminate\Database\Seeder;
use Siravel\Services\UserService;
use App\Models\User;
use App\Models\Role;

class SystemUserTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();

        $adminRole = Role::whereName('administrator')->first();
        $user = User::create(array(
            'name'    => 'Sierra Tecnologia',
            'username'    => 'sierratecnologia',
            'email'         => 'simaster@sierratecnologia.com.br',
            'password'      => Hash::make('123456'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($adminRole);

        $userRole = Role::whereName('user')->first();
        $user = User::create(array(
            'name'    => 'Ricardo Sierra',
            'username'    => 'ricardosierra',
            'email'         => 'clientes@sierratecnologia.com.br',
            'password'      => Hash::make('123456'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($userRole);

	}

}
