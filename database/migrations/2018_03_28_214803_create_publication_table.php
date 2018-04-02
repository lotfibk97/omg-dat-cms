<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('publications', function (Blueprint $table) {
            $table->string('description');
            $table->increments('id');
            $table->string('title','30');
            $table->unsignedInteger('owner');
            $table->foreign('owner')->references('id')->on('users');
            $table->Integer('grid_rows');
            $table->Integer('selected');
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
        Schema::dropIfExists('publications');
    }
}
