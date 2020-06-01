<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogArticleSeeder extends Seeder
{

	public function run()
	{

		factory(App\Models\Blog\Blog::class, rand(1, 50))->create();
		factory(App\Models\Blog\Category::class, rand(1, 5))->create();

	}
}
