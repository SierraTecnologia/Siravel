<?php

namespace Mattmangoni\NovaBlogifyTool\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CommentMigration
{
    public function up()
    {
        Schema::create(config('app.db-prefix', '').'comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('user_id');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
