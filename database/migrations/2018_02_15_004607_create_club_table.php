<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubTable extends Migration
{

    public function up()
    {
        Schema::create('club', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('license_no', 30);
            $table->timestamps();
            $table->unique('license_no');
        });
    }

    public function down()
    {
        Schema::drop('club');
    }
}
