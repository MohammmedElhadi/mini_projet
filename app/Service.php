<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function courriers()
    {
        return $this->hasMany('App\Courrier');
    }
    public function services()
    {
        return $this->hasMany('App\Service');
    }
    public function typrservice()
    {
        return $this->belongsTo('App\Typeservice');
    }
    public function user()
    {
        return $this->belongsTo('App\User')->using('App\ChefService');
    }
    public function users()
    {
        return $this->belongsTo('App\User')->using('App\ElementService');
    }

}
