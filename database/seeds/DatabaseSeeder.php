<?php

use Illuminate\Database\Seeder;
<<<<<<< HEAD

=======
use App\Classement;
use App\Mention;
use App\Typecourrier;
use App\User;
use App\Typeservice;
use App\Grade;
use App\Service;
use Illuminate\Support\Facades\Hash;



>>>>>>> Sync_again_01-09
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
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
=======
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
        Grade::create([
            'nom_grade' => 'grade1',
            'abr_grade' => 'g1'
        ]);
        service::create([
            'nom_service' => 'sevice1',
            'user_id' => '1',
            'abr_service' => 's1'
        ]);

>>>>>>> Sync_again_01-09
    }
}
