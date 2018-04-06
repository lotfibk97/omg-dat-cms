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
            $table->longText('description')->nullable();
            $table->enum('type',['text','image','audio','video'])->default('text');
            $table->unsignedInteger('publication');
            $table->foreign('publication')->references('id')->on('publications');
            $table->unsignedInteger('creator');
            $table->foreign('creator')->references('id')->on('collaborators');
            $table->longText('html')->nullable();
            $table->unsignedInteger('top')->default(2);
            $table->unsignedInteger('left')->default(5);
            $table->unsignedInteger('width')->default(4);
            $table->unsignedInteger('height')->default(4);
            $table->boolean('hcenter')->default(0);
            $table->boolean('vcenter')->default(0);
            $table->boolean('displayed')->default(0);
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
