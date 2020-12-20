<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function user(){
        return $this->hasOne('App\Models\User', 'id' , 'user_id');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order', 'client_id' , 'id');
    }
}
