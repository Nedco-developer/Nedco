<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'Driver_id',
        'Order_id',
        'delivery_date',
    ];


    public function order()
    {
        return $this->hasOne('App\Models\Order', 'id' , 'Order_id');
    }
    public function order2()
    {
        return $this->hasOne('App\Models\Order', 'status','Delivered');
    }

    public function driver()
    {
        return $this->hasOne('App\Models\Driver', 'id' , 'Driver_id');
    }

    public function cancelledOrder()
    {
        return $this->hasOne('App\Models\CancelledOrders', 'order_id' , 'Order_id');
    }
}
