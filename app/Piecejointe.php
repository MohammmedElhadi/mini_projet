<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piecejointe extends Model
{
    public $guarded = [];
    public function courrier()
    {
        return $this->belongsTo('App\Courrier');
    }
}
