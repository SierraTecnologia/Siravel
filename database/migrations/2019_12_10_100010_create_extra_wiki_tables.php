<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraWikiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'wiki_roles', function (Blueprint $table) {

                // Set the storage engine and primary key
                $table->engine = 'InnoDB';
                $table->increments('id');

                // Ordinary columns
                $table->string('name')->unique();
                $table->boolean('is_default')->unsigned()->default(0);

                // Automatic columns
                $table->timestamps();
            }
        );
        Schema::create(
            'wiki_users', function (Blueprint $table) {

                // Set the storage engine and primary key
                $table->engine = 'InnoDB';
                $table->increments('id');

                // Ordinary columns
                $table->string('uuid');
                $table->string('name')->nullable();
                $table->string('nickname')->nullable();
                $table->string('email')->nullable();
                $table->string('avatar')->nullable();
                $table->unsignedInteger('login_count')->default(0);

                // Foreign keys
                // $table->string('language_code');
                // $table->foreign('language_code')->references('code')->on('languages')->onUpdate('cascade')->onDelete('cascade');
                $table->unsignedInteger('provider_id');
                // $table->foreign('provider_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
                $table->unsignedInteger('wiki_role_id');
                // $table->foreign('role_id')->references('id')->on('wiki_roles')->onUpdate('cascade')->onDelete('restrict');

                // Extra keys
                $table->unique(['uuid', 'provider_id']);
                $table->unique(['email', 'provider_id']);

                // Automatic columns
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::create(
            'wiki_categories', function (Blueprint $table) {

                // Set the storage engine and primary key
                $table->engine = 'InnoDB';
                $table->increments('id');

                // Ordinary columns
                $table->string('name');
                $table->unsignedInteger('parent_id')->nullable();
                $table->unsignedInteger('lft');
                $table->unsignedInteger('rgt');
                $table->unsignedInteger('depth')->default(0);

                // Extra keys
                $table->unique(['parent_id', 'name']);

                // Automatic columns
                $table->timestamps();
            }
        );
        Schema::create(
            'wiki_pages', function (Blueprint $table) {

                // Set the storage engine and primary key
                $table->engine = 'InnoDB';
                $table->increments('id');

                // Ordinary columns
                $table->string('name');
                $table->longText('source');
                $table->longText('markup')->nullable();

                // Foreign keys
                $table->unsignedInteger('wiki_category_id');
                $table->foreign('wiki_category_id')->references('id')->on('wiki_categories')->onUpdate('cascade')->onDelete('cascade');

                // Automatic columns
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'wiki_versions', function (Blueprint $table) {

                // Set the storage engine and primary key
                $table->engine = 'InnoDB';
                $table->increments('id');

                // Ordinary columns
                $table->string('name');
                $table->longText('source');
                $table->string('ip_address', 45);

                // Foreign keys
                $table->unsignedInteger('wiki_page_id');
                $table->foreign('wiki_page_id')->references('id')->on('wiki_pages')->onUpdate('cascade')->onDelete('cascade');
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('id')->on('wiki_users')->onUpdate('cascade')->onDelete('cascade');

                // Automatic columns
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
        Schema::dropIfExists('wiki_versions');
        // Pages
        Schema::dropIfExists('wiki_pages');
        Schema::dropIfExists('wiki_categories');
        Schema::dropIfExists('wiki_users');
        Schema::dropIfExists('wiki_roles');
        // Providers
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}
