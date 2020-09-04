<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    protected $guarded = []; 
    public function services()
    {
        return $this->belongsToMany('App\Service');
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
    public function piece_jointe(){
        return $this->hasMany('App\Piecejointe');
    }
}
