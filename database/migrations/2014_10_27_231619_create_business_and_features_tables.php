<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessAndFeaturesTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Schema::create('settings', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->string('code'); //->unique();
        //     // $table->primary('code');
        //     $table->string('value')->default(false);
        //     $table->string('business_code')->nullable();
        //     // $table->foreign('business_code')->references('code')->on('businesses');
        //     $table->timestamps();
        //     $table->softDeletes();
            
        //     $table->primary(['code', 'business_code']);
        // });
        
        Schema::create(
            'features', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('code')->unique();
                $table->primary('code');
                $table->string('name', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'featureables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('featureable_id');
                $table->string('featureable_type', 255);
                $table->string('feature_code');
                $table->foreign('feature_code')->references('code')->on('features');
                $table->timestamps();
                $table->softDeletes();
            }
        );

        // /**
        //  * Cards
        //  */
        // Schema::create('cards', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id')->unsigned();
            
        //     $table->integer('status')->nullable();
        //     $table->integer('integration_id')->nullable();
        //     $table->string('title');
        //     $table->string('description');
        //     $table->string('subTitle');
        //     $table->float('price');
        //     $table->string('subDescription');
        //     $table->string('image');
        //     $table->string('imagesTitle');
        //     $table->string('text1');
        //     $table->string('text2');
        //     $table->string('text3');
        //     $table->string('text4');
        //     $table->string('buttonName');
        //     $table->string('buttonNewPage');
        //     $table->string('buttonLink');

        //     $table->timestamps();
        //     $table->softDeletes();
        // });
        
        // Schema::create('cardables', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id')->unsigned();
        //     $table->integer('card_id')->unsigned();
        //     $table->boolean('is_sincronizado')->default(false);
        //     $table->integer('cardable_id')->nullable();
        //     $table->string('cardable_type', 255)->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
        // Schema::create('cardSlides', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title');
        //     $table->string('image');
        //     $table->unsignedInteger('card_id');
        //     $table->foreign('card_id')->references('id')->on('cards');
        //     $table->timestamps();
        // });
        


        // /**
        //  * Gambles
        //  */
        // Schema::create('gambles', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id')->unsigned();
            
        //     $table->integer('min_participantes')->nullable();
        //     $table->boolean('max_participantes')->nullable();
        //     $table->string('premio', '');
            
        //     $table->unsignedInteger('user_id')->nullable();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
        // Schema::create('gamble_actions', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->increments('id')->unsigned();
        //     $table->unsignedInteger('cupons');
            

        //     $table->unsignedInteger('gamble_id')->nullable();
        //     $table->foreign('gamble_id')->references('id')->on('gambles')->onDelete('set null');
        //     $table->unsignedInteger('user_id')->nullable();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('identity_girls');
    }

}
