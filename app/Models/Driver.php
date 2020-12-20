<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function user(){
        return $this->hasOne('App\Models\User', 'id' , 'user_id');
    }
    
    public function orders(){
        return $this->hasMany('App\Models\AssignOrders', 'Driver_id' , 'id');
    }
}
