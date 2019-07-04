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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('creator');
            $table->string('type');
            $table->bigInteger('year');
            $table->string('site');
            $table->string('version');
            $table->string('against');
            $table->string('pro');
            $table->integer('id_language')->unsigned()->references( 'languages' )->on('id') ;;
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
        Schema::dropIfExists('frameworks');
    }
}
