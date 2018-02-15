<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{

    public function up()
    {
        Schema::create('event', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->date('date');
            $table->integer('club_id')->unsigned();
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('event');

        });
    }

    public function down()
    {
        Schema::drop('event');
    }
}
