<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    public function users(){
        return $this->belongsToMany('App\user');
    }
}
