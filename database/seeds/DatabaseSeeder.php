<?php

use Illuminate\Database\Seeder;
use App\Typeservice;
use App\Service;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Typeservice::create([
            'nom_type_service' => 'type1',
            'abr_type_service' => 't1',

        ]);
    
        Typeservice::create([
            'nom_type_service' => 'type2',
            'abr_type_service' => 't2',

        ]);
    
        Typeservice::create([
            'nom_type_service' => 'type3',
            'abr_type_service' => 't3',

        ]);

        Service::create([
            'nom_service' => 'service1',
            'abr_service' => 's1',
            
        ]);
        Service::create([
            'nom_service' => 'service2',
            'abr_service' => 's2',
            'service_id'  =>'1'
        ]);
        Service::create([
            'nom_service' => 'service3',
            'abr_service' => 's3',
            'service_id'  => '2'
        ]);
        Service::create([
            'nom_service' => 'service4',
            'abr_service' => 's4',
            'service_id'  =>'1'
        ]);
        // $this->call(UserSeeder::class);
    }
}
