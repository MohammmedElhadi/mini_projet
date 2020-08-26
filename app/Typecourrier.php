<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typecourrier extends Model
{
    public function courriers()
    {
        return $this->hasMany('App\Courrier');
    }
}
