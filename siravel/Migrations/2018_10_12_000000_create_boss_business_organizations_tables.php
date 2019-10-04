<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBossBusinessOrganizationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('status')->default(1);
            $table->string('site')->nullable();
            $table->timestamps();
        });
        Schema::create('business_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug')->nullable();
            $table->integer('status')->default(1);
            $table->integer('business_sector_id')->unsigned()->nullable();

            $table->timestamps();
        });

        Schema::create('business_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status')->default(1);
            $table->integer('business_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('business_collaborators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('cpf')->nullable();
            $table->integer('status')->default(1);
            $table->integer('business_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_products');
        Schema::dropIfExists('business_collaborators');
        Schema::dropIfExists('business_sectors');
        Schema::dropIfExists('organizations');
    }
}
