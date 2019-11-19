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
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->string('rg')->unique()->nullable();
            $table->string('ra')->unique()->nullable();
            $table->boolean('approved')->default(0);
            $table->boolean('administrator')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->boolean('first_login')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('course_id');
        });
        Schema::dropIfExists('users');
    }
}
