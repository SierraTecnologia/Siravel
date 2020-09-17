<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ScopeForBusinessInTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('analytics')) {
            Schema::table('analytics', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('posts')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('articles')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('menus')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('promotions')) {
            Schema::table('promotions', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('widgets')) {
            Schema::table('widgets', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('cards')) {
            Schema::table('cards', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('user_meta')) {
            Schema::table('user_meta', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('settings')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');

                $table->unique(['setting_key', 'business_code']);
            });
        }
        if (Schema::hasTable('followables')) {
            Schema::table('followables', function (Blueprint $table) {
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
    }
}
