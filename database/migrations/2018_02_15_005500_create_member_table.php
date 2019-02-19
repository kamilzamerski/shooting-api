<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{

    public function up()
    {
        Schema::create('member', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->date('date_of_join');
            $table->string('pesel', 11);
            $table->string('address_street', 50);
            $table->string('address_street_no', 10);
            $table->string('address_apartment_no', 10);
            $table->string('post_code', 6);
            $table->string('city', 50);
            $table->string('shooting_license', 20);
            $table->string('email', 50);
            $table->string('phone', 50);
            $table->date('active_to')->nullable();
            $table->integer('shooter_id')->unsigned();

            $table->foreign('shooter_id')->references('id')->on('shooter');

        });
    }

    public function down()
    {
        Schema::dropIfExists('member');
    }
}
