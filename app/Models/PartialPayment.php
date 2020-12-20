<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartialPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function order(){
        return $this->hasOne('App\Models\Order', 'id' , 'order_id');
    }
}
