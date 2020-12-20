<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationsPrices extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'location_id', 'price'];
}
