<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSexRelationsTables extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /**
         * Gambles
         */
		Schema::create('gambles', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
            
			$table->integer('min_participantes')->nullable();
			$table->boolean('max_participantes')->nullable();
			$table->string('premio', '');
            
			$table->unsignedInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->timestamps();
            $table->softDeletes();
		});
		Schema::create('gamble_actions', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
            $table->unsignedInteger('cupons');
            

			$table->unsignedInteger('gamble_id')->nullable();
			$table->foreign('gamble_id')->references('id')->on('gambles')->onDelete('set null');
			$table->unsignedInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('identity_slaves');
	}

}
