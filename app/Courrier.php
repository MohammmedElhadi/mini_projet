<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
<<<<<<< HEAD
    public function services()
    {
        return $this->belongsToMany('App\Service');
=======
    public function users(){
        return $this->belongsToMany('App\user');
>>>>>>> Sync_again_01-09
    }
}
