<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
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
            $table->string('title','30');
            $table->string('description');
            $table->string('type');
            $table->unsignedInteger('publication_id');
            $table->foreign('publication_id')->references('id')->on('publications');
            $table->unsignedInteger('creator');
            $table->foreign('creator')->references('id')->on('users');
            $table->unsignedInteger('responsible');
            $table->foreign('responsible')->references('id')->on('users');
            $table->unsignedInteger('content');
            $table->string('html');
            // $table->foreign('content')->references('id')->on('textcontent');
            $table->string('top');
            $table->string('left');
            $table->string('width');
            $table->string('height');
            $table->boolean('auto-height');
            $table->boolean('center-v');
            $table->string('center-h');
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
