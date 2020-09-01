<?php

use Illuminate\Database\Seeder;
use App\Typeservice;
use App\Service;
use App\Classement;
use App\Mention;
use App\typecourrier;
use App\User;
use App\Grade;

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
            'nom_type_service' => 'type_service1',
            'abr_type_service' => 'ts1',
        ]);
    
        Typeservice::create([
            'nom_type_service' => 'type_service2',
            'abr_type_service' => 'ts2',
        ]);
    
        Typeservice::create([
            'nom_type_service' => 'type_service3',
            'abr_type_service' => 'ts3',
        ]);


        $this->call(CourrierSeeder::class);
        Classement::create([
            'nom_class' => 'class1'
        ]);
        Classement::create([
            'nom_class' => 'class2'
        ]);
        Mention::create([
            'nom_mention' => 'mention1'
        ]);
        Mention::create([
            'nom_mention' => 'mention2'
        ]);
        Typecourrier::create([
            'nom_typecourrier' => 'typecourrier1'
        ]);
        Typecourrier::create([
            'nom_typecourrier' => 'typecourrier2'
        ]);
        User::create([
            'nom' => 'ElHarachi',
            'prenom' => 'Hamid',
            'matricule' => '201500099999',
            'email' => 'hamid@gmail.com',
            'telephone' => '0777999333',
            'password' => Hash::make('password'),
            'grade_id' => '1',
            'service_id' => '1'

        ]);
        User::create([
            'nom' => 'Philipe',
            'prenom' => 'Mansour',
            'matricule' => '201500099990',
            'email' => 'Mansour@gmail.com',
            'telephone' => '0777999330',
            'password' => Hash::make('password'),
            'grade_id' => '2',
            'service_id' => '2'

        ]);
        Grade::create([
            'nom_grade' => 'grade1',
            'abr_grade' => 'g1'
        ]);
        Grade::create([
            'nom_grade' => 'grade2',
            'abr_grade' => 'g2'
        ]);
        Service::create([
            'nom_service' => 'service1',
            'abr_service' => 's1',
            'user_id' => '1'
            
        ]);
        Service::create([
            'nom_service' => 'service2',
            'abr_service' => 's2',
            'service_id'  =>'1',
            'user_id' => '1'

            ]);
        Service::create([
            'nom_service' => 'service3',
            'abr_service' => 's3',
            'service_id'  => '2',
            'user_id' => '2'

        ]);
        Service::create([
            'nom_service' => 'service4',
            'abr_service' => 's4',
            'service_id'  =>'1',
            'user_id' => '1'

        ]);
    }
}
