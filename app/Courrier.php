<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }
}
