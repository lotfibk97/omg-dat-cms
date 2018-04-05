<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->date('date')->nullable();
            $table->boolean('published')->default(0);
            $table->string('url')->nullable();
            $table->unsignedInteger('rows')->default(20);
            $table->unsignedInteger('selected')->nullable();
            $table->unsignedInteger('user');
            $table->foreign('user')->references('id')->on('users');
            // $table->enum('status',['in progress','published'])->default('in progress');
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
