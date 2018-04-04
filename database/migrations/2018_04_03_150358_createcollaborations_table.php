<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatecollaborationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('publication');
            $table->foreign('publication')->references('id')->on('publications');
            $table->unsignedInteger('collaborator');
            $table->foreign('collaborator')->references('id')->on('collaborators');
            $table->enum('role',['publicator','editor','media-manager','any'])->default('any');
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
        Schema::dropIfExists('collaborations');
    }
}
