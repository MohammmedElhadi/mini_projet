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
    public function chef_service()
    {
        return $this->belongsTo('App\User');
    }
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
