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
            $table->id();
            $table->string('openid',120)->unique();
            $table->string('mallcoo_id',120)->unique()->nullable();
            $table->string('mallcoo_nickname')->nullable();
            $table->string('mallcoo_avatar')->nullable();
            $table->unsignedSmallInteger('team')->nullable();//1,2队
            $table->unsignedInteger('points')->default(0);
            $table->string('session_key')->nullable();
            $table->timestamp('joined_at')->nullable();
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
