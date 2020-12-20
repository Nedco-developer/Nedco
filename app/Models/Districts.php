<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
        
    public function districts_prices() {
        return $this->hasOne('App\Models\DistrictsPrices', 'district_id', 'id' );
    }
    protected $fillable = ['price'];
}
