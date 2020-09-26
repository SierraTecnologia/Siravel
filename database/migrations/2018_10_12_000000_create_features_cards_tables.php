<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesCardsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
         * Pego do CMS
         */

        /**
         * Cards
         */
        Schema::create(
            config('app.db-prefix', '').'cards', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
            
                $table->integer('status')->nullable();
                $table->integer('integration_id')->nullable();
                $table->string('title');
                $table->string('description');
                $table->string('subTitle');
                $table->float('price');
                $table->string('subDescription');
                $table->string('image');
                $table->string('imagesTitle');
                $table->string('text1');
                $table->string('text2');
                $table->string('text3');
                $table->string('text4');
                $table->string('buttonName');
                $table->string('buttonNewPage');
                $table->string('buttonLink');

                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            config('app.db-prefix', '').'cardables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->integer('card_id')->unsigned();
                $table->boolean('is_sincronizado')->default(false);
                $table->integer('cardable_id')->nullable();
                $table->string('cardable_type', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            config('app.db-prefix', '').'cardSlides', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('image');
                $table->unsignedInteger('card_id');
                $table->foreign('card_id')->references('id')->on(config('app.db-prefix', '').'cards');
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
        Schema::dropIfExists('cardSlides');
        Schema::dropIfExists('cardables');
        Schema::dropIfExists('cards');
    }
}
