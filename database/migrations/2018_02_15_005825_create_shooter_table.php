<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShooterTable extends Migration
{

    public function up()
    {
        Schema::create('shooter', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 50);
            $table->integer('club_id')->nullable()->unsigned();
            $table->string('license_no', 30)->nullable()->unique();

            $table->foreign('club_id')->references('id')->on('club');

        });
    }

    public function down()
    {
        Schema::drop('shooter');
    }
}
