<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('comment')->nullable();
            //$table->text('share')->nullable();
            //$table->text('content_type')->nullable();
            $table->text('content_url')->nullable();
            $table->integer('view_number')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            // $table->unsignedBigInteger('group_id')->references('id')->on('groups');
            $table->boolean('react')->default(true);
            // $table->integer('count_react')->;
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
        Schema::dropIfExists('posts');
    }
}
