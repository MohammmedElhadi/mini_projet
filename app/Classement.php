<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classement extends Model
{
    public function courriers()
    {
        return $this->hasMany('App\Courrier');
    }
}
