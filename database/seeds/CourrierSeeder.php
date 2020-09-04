<?php

use Illuminate\Database\Seeder;

class CourrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Courrier'::class,20)->create();
    }
}
