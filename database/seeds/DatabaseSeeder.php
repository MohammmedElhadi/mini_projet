<?php

use Illuminate\Database\Seeder;
use App\Classement;
use App\Mention;
use App\Typecourrier;
use App\User;

use App\Grade;
use App\Service;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
