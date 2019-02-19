<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultTable extends Migration
{

    public function up()
    {
        Schema::create('result', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('event_id')->unsigned();
            $table->integer('shooter_id')->unsigned();
            $table->integer('competition')->unsigned();
            $table->float('point_sum');
            $table->float('time_sum');
            $table->json('results');

            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('shooter_id')->references('id')->on('shooter');


        });
    }

    public function down()
    {
        Schema::dropIfExists('result');
    }
}
