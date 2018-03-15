<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{

    public function up()
    {
        Schema::create('event', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 255);
            $table->date('date');

        });
    }

    public function down()
    {
        Schema::drop('event');
    }
}
