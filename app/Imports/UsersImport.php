<?php

namespace App\Imports;

use App\Grade;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(! User::where('matricule',$row[2])->get()->first()){
            $grade = Grade::where('nom_grade',$row[4])->get()->first();
            $service = Service::where('nom_service',$row[5])->get()->first();
            return new User([
                'nom'     => $row[0],
                'prenom'    => $row[1], 
                'matricule'    => $row[2], 
                'telephone'    => $row[3], 
                'email'    => $row[0].".".$row[2].'@emp.dz',
                'grade_id'    => $grade->id, 
                'service_id'    => $service->id, 
                'password' => Hash::make($row[2]),
            ]);
        }
            return null;
    }
}
