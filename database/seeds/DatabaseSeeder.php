<?php

use Illuminate\Database\Seeder;
use App\Typeservice;
use App\Service;
use App\Classement;
use App\Mention;
use App\typecourrier;
use App\User;
use App\Grade;
use Spatie\Permission\Models\Role;
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

        factory('App\Courrier'::class,20)->create();

        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'element']);
        $role = Role::create(['name' => 'chef_service']);


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
            'nom' => 'admin',
            'prenom' => 'admin',
            'est_admin' => true,
            'matricule' => '201500099999',
            'email' => 'admin@admin.com',
            'telephone' => '0777999333',
            'password' => Hash::make('password'),
            'grade_id' => '1',
            'service_id' => '1',
            ])->assignRole(['admin']);
            
            


        User::create([
            'nom' => 'element',
            'prenom' => 'element',
            'matricule' => '201500099990',
            'email' => 'element@element.com',
            'telephone' => '0777999330',
            'password' => Hash::make('password'),
            'grade_id' => '2',
            'service_id' => '2',
            ])->assignRole(['element']);
            





        //chef  services
        User::create([
            'nom' => 'chef ',
            'prenom' => ' service 1',
            'matricule' => '201500099994',
            'email' => 'chef1@chef1.com',
            'telephone' => '0777999830',
            'password' => Hash::make('password'),
            'grade_id' => '1',
            'service_id' => '1',
            'est_chef' => true
        ])->assignRole(['chef_service']);  

        User::create([
            'nom' => 'chef',
            'prenom' => 'service 2',
            'matricule' => '201700099994',
            'email' => 'chef2@chef2.com',
            'telephone' => '0077999730',
            'password' => Hash::make('password'),
            'grade_id' => '1',
            'service_id' => '2',
            'est_chef' => true
        ])->assignRole(['chef_service']);  

        User::create([
            'nom' => 'chef' ,
            'prenom' => ' service 3',
            'matricule' => '201800099994',
            'email' => 'chef3@chef3.com',
            'telephone' => '0777099730',
            'password' => Hash::make('password'),
            'grade_id' => '1',
            'service_id' => '3',
            'est_chef' => true
        ])->assignRole(['chef_service']);  


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
            'user_id' => '3'
            
        ]);
        Service::create([
            'nom_service' => 'service2',
            'abr_service' => 's2',
            'service_id'  =>'1',
             'user_id' => '4'

            ]);
        Service::create([
            'nom_service' => 'service3',
            'abr_service' => 's3',
            'service_id'  => '2',
            'user_id' => '5'

        ]);
         
        
    }
}
