<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictsPrices extends Model
{
    use HasFactory;
    public function Districts(){
        return $this->hasOne('App\Models\Districts', 'id' , 'district_id');
    }
    public function user(){
        return $this->hasOne('App\Models\User', 'id' , 'user_id');
    }
    protected $fillable = ['user_id', 'district_id', 'price'];
}
