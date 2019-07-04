<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrameworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frameworks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('creator');
            $table->string('type');
            $table->bigInteger('year');
            $table->string('site');
            $table->string('version');
            $table->string('against');
            $table->longText('image');
            $table->string('pro');
            $table->integer('id_language')->unsigned();
            $table->timestamps();
        });

        Schema::table('frameworks', function($table) {
            $table->foreign('id_language')->references('id')->on('languages');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frameworks');
    }
}
