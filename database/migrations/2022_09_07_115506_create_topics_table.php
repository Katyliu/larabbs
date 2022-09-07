<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	public function up()
	{
		Schema::create('topics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->default('')->index();
            $table->text('body')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable()->default(0)->index();
            $table->integer('category_id')->unsigned()->nullable()->default(0)->index();
            $table->integer('reply_count')->unsigned()->nullable()->default(0);
            $table->integer('view_count')->unsigned()->nullable()->default(0);
            $table->bigInteger('last_reply_user_id')->unsigned()->nullable()->default(0);
            $table->integer('order')->unsigned()->nullable()->default(0);
            $table->text('excerpt')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('topics');
	}
};
