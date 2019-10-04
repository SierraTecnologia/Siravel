<?php

namespace Siravel\Console\Commands\PhotoApp;

use App\Models\Role;
use SiObjects\Manipule\Entities\UserEntity;
use Illuminate\Console\Command;

/**
 * Class CreateRoles.
 *
 * @package Siravel\Console\Commands\PhotoApp
 */
class CreateRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create roles';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        if (!Role::exists()) {
            Role::insert([
                ['name' => UserEntity::ROLE_ADMINISTRATOR],
                ['name' => UserEntity::ROLE_CUSTOMER],
            ]);
        }
    }
}
