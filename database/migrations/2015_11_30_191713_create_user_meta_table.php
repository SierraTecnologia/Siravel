<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        if (!Schema::hasTable(config('app.db-prefix', '').'user_meta')) {
            Schema::create(config('app.db-prefix', '').'user_meta', function (Blueprint $table) {
                $table->increments('id');
    
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    
                $table->string('phone')->nullable();
    
                $table->boolean('is_active')->default(0);
                $table->string('activation_token')->nullable();
    
                $table->boolean('marketing')->default(0);
                $table->boolean('terms_and_cond')->default(1);
                
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
    
                $table->timestamps();
            });
        }
        

        if (!Schema::hasColumn(config('app.db-prefix', '').'user_meta', 'business_code')) {
            Schema::create(config('app.db-prefix', '').'user_meta', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_meta');
    }
}
