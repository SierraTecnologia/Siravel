<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScopeForBusinessInTables extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('analytics', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
		
        Schema::table('blogs', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
        Schema::table('posts', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
		
        Schema::table('articles', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
        Schema::table('pages', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
		
        Schema::table('menus', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
		
        Schema::table('promotions', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
		
        Schema::table('widgets', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
		
        Schema::table('cards', function (Blueprint $table) {
			$table->string('business_code');
            $table->foreign('business_code')->references('code')->on('businesses');
		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        
	}

}
