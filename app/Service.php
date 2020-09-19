<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $guarded = [];
    public function courriers()
    {
        return $this->belongsToMany('App\Courrier')->withTimeStamps();
    }
    public function sous_service()
    {
        return $this->hasMany('App\Service','service_id');
    }

    public function service_pere()
    {
        return $this->belongsTo('App\Service' , 'service_id');
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
