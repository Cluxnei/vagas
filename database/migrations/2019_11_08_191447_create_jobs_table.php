<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedTinyInteger('beginning_semester')->nullable();
            $table->unsignedTinyInteger('final_semester')->nullable();
            $table->text('requirement');
            $table->text('benefits');
            $table->string('link')->nullable();
            $table->string('status')->default('pendent');
            $table->unsignedBigInteger('administrator_id');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();
            $table->foreign('administrator_id')->references('id')->on('administrators');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign('administrator_id');
            $table->dropForeign('company_id');
        });
        Schema::dropIfExists('jobs');
    }
}
