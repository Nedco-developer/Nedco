<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function client(){
        return $this->hasOne('App\Models\Client', 'user_id', 'id');
    }

    public function driver(){
        return $this->hasOne('App\Models\Driver', 'user_id', 'id');
    }

    public function monitor(){
        return $this->hasOne('App\Models\Monitor', 'user_id', 'id');
    }

    public function dispatcher(){
        return $this->hasOne('App\Models\Dispatcher', 'user_id', 'id');
    }

    public function finance(){
        return $this->hasOne('App\Models\Finance', 'user_id', 'id');
    }
    public function admin(){
        return $this->hasOne('App\Models\Admin', 'user_id', 'id');
    }
    public function pickup(){
        return $this->hasOne('App\Models\Pickedup', 'user_id', 'id');
    }
    public function pickedup(){
        return $this->hasOne('App\Models\Pickedup', 'user_id', 'id');
    }
}
