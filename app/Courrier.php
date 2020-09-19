<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    protected $guarded = []; 
    public function services()
    {
        return $this->belongsToMany('App\Service')->withTimeStamps();
    }
    public function destinateurs(){
        return $this->belongsToMany('App\user');
    }
    public function expditeur(){
        return $this->belongsTo('App\user','user_id');
    }
    public function classement(){
        return $this->belongsTo('App\Classement','classement_id');
    }
    public function mention(){
        return $this->belongsTo('App\Mention','mention_id');
    }
    public function typecourrier(){
        return $this->belongsTo('App\Typecourrier','typecourrier_id');
    }
    public function motcles()
    {
        return $this->belongsToMany('App\Mocle');
    }
    public function piece_jointe(){
        return $this->hasMany('App\Piecejointe');
    }

    public function getDests(){
       
        $services  = $this->services()->where('exp_dest',0)->get();
        return $services;
    }

    public function getExp(){
        
        $services  = $this->services()->where('exp_dest',1)->get();
        return $services;
    }
}
