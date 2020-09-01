<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $guarded = [];
    public function courriers()
    {
        return $this->belongsToMany('App\Courrier');
    }
    public function sous_service()
    {
        return $this->hasMany('App\Service');
    }

    public function service_pere()
    {
        return $this->belongsTo('App\Service' , 'service_id');
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
