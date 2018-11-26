<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubTable extends Migration
{

    public function up()
    {
        Schema::create('club', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('club');
    }
}
