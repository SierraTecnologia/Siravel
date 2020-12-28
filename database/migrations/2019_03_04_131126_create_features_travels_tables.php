<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTravelsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create(config('siravel.db-prefix', '').'travels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('destine');
            $table->date('date_init');
            $table->date('date_end');
            $table->integer('adults');
            $table->integer('chieldren');
            $table->integer('aparts');
            $table->integer('status');
            $table->string('reserve');
            $table->string('reserve_token');
            $table->integer('user_id');
            $table->string('navigator');
            $table->string('email');
            $table->string('user_token');
            $table->integer('apart_id'); //->unsigned()->after('id');
//            $table->foreign('apart_id')->references('id')->on('aparts');

            // $table->integer('hotel_id'); //->unsigned()->after('id');
//            $table->foreign('hotel_id')->references('id')->on('hotels');
			$table->string('business_code');
            // $table->foreign('business_code')->references('code')->on('businesses');
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
        Schema::dropIfExists('travels');
    }
}
