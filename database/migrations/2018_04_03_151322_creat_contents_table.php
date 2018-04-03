<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->enum('type',['text','image','audio','video']);
            $table->unsignedInteger('publication');
            $table->foreign('publication')->references('id')->on('publications');
            $table->unsignedInteger('creator');
            $table->foreign('creator')->references('id')->on('collaborators');
            $table->unsignedInteger('responsible');
            $table->foreign('responsible')->references('id')->on('collaborators');
            $table->longText('html');
            $table->unsignedInteger('top');
            $table->unsignedInteger('left');
            $table->unsignedInteger('width');
            $table->unsignedInteger('height');
            $table->boolean('center-h');
            $table->boolean('center-v');
            $table->boolean('displayed');
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
        Schema::dropIfExists('contents');
    }
}
