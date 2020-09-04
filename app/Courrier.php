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
}
