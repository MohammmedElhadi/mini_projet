<?php

use Illuminate\Database\Seeder;
use App\Courrier;
class CourrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courrier = factory(App\Courrier::class,20)->create();
    }
}
