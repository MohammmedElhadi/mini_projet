<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    public function courriers()
    {
        return $this->hasMany('App\Courrier');
    }
}
