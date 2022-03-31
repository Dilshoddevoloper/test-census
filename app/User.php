<?php

namespace App;

use App\Models\Roles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password','login','password', 'region_id', 'city_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function city() {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function region() {
        return $this->belongsTo('App\Region', 'region_id');
    }

//    public function isAdmin()
//    {
//        return $this->roles()->first()->name == 'admin';
//    }
//
//    public function isRegion()
//    {
//        return $this->roles()->where('name', 'region')->exists();
//    }
//
//    public function isCity()
//    {
//        return $this->roles()->where('name', 'city')->exists();
//    }






}
