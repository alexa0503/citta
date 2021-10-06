<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $casts = [
        'is_activated' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getIsActivatedAttribute($value)
    {
        return $value == 1 ? true : false;
    }
    // public function not_exchanged_points()
    // {
    //     return $this->hasMany('App\PointsLog', 'user_id', 'id')->whereNotNull('prize_id')->where('state',0);
    // }

    public function gifts()
    {
        return $this->hasMany('App\Models\UserGift', 'user_id', 'id');
    }
}