<?php

use Illuminate\Database\Seeder;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('club')->insert([
            'id' => 1,
            'name' => 'Nadnarwianka Pułtusk Sekcja Strzelecka'
        ]);
    }
}
