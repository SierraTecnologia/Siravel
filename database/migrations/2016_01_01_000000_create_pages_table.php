<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Siravel\Models\Negocios\Page;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create(
            'pages', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('author_id');
                $table->string('title');
                $table->string('url')->nullable();
                $table->string('slug')->nullable();
                $table->text('entry')->nullable();
                $table->string('seo_description')->nullable();
                $table->string('seo_keywords')->nullable();
                $table->boolean('is_published')->default(0);
                $table->text('excerpt')->nullable();
                $table->text('body')->nullable();
                $table->string('image')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('meta_keywords')->nullable();
    
                $table->text('blocks')->nullable();
                $table->string('hero_image')->nullable();
    
                $table->enum('status', Page::$statuses)->default(Page::STATUS_INACTIVE);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
