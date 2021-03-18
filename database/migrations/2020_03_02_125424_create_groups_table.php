<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->unsignedInteger('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->string('about')->nullable();
            $table->string('type')->nullable();
            $table->string('position')->nullable();
            $table->string('image')->nullable();
            $table->text('group_url')->nullable();
            $table->string('Created_by', 999);
            // $table->unsignedBigInteger('creator_id')->references('id')->on('users');
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('groups');
    }
}
