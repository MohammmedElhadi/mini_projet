<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motcle extends Model
{
    public function courriers()
    {
        return $this->belongsToMany('App\Courrier');
    }
}
