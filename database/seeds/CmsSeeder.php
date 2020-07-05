<?php

use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(Siravel\Models\Negocios\Page::class, rand(1, 10))->create();
		factory(Siravel\Models\Negocios\Menu::class, rand(1, 10))->create();
    }
}
