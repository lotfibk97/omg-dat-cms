<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextcontentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //     Schema::create('textcontents', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->string('description');
    //         $table->unsignedInteger('maincontent');
    //         $table->foreign('maincontent')->references('id')->on('content');
    //         $table->string('html');
    //         $table->timestamps();
    //     });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('textcontents');
    }
}
