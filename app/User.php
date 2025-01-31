<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{   
    use HasRoles;
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function service(){
        return $this->belongsTo('App\Service');
    }

    public function grade(){
        return $this->belongsTo('App\grade');
    }

    public function courriers_envoyer(){
        return $this->HasMany('App\Courrier');
    }
    public function courriers_recu(){
        return $this->belongsToMany('App\Courrier','courrier_id');
    }


}
