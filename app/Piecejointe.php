<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piecejointe extends Model
{
    public function courrier()
    {
        return $this->belongsTo('App\Courrier');
    }
}
