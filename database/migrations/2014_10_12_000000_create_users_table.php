<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->unique();
            $table->string('password');
            $table->string('phone',15)->unique();
            $table->string('image')->unique()->nullable();
            // $table->string('whatsapp')->unique();
            // $table->string('telegram')->unique();
            // $table->string('facebook')->unique();
            // $table->string('twitter')->unique();
            // $table->string('snapchat')->unique();
            // $table->string('instagram')->unique();
            $table->string('address')->unique()->nullable();
            $table->boolean('active')->default(1)->nullable();
            
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->integer('number_posts')->nullable();
            $table->integer('number_groups')->nullable();
            $table->integer('number_following_groups')->nullable();
            $table->boolean('is_admin')->default(false)->nullable();
            $table->boolean('accepted_notifications')->default(true)->nullable();
            $table->string('uid')->nullable();
            $table->unsignedInteger('city_id')->references('id')->on('cities')->nullable();
            $table->string('token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
