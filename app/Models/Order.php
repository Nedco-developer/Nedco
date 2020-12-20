<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'client_id',
        'SenderNumber',
        'SenderName',
        'RecipientNumber',
        'RecipientName',
        'city',
        'districts',
        'locations',
        'RecipientAddress',
        'itemPrice',
        'deliveryPrice',
        'totalPrice',
        'lat',
        'lon',
        'notes',
        'barcode',
    ];

    public function client(){
        return $this->hasOne('App\Models\Client', 'id' , 'client_id');
    }

    public function assigned_order(){
        return $this->hasOne('App\Models\AssignOrders', 'Order_id' , 'id');
    }

    public function cancelledOrder()
    {
        return $this->hasOne('App\Models\CancelledOrders', 'order_id' , 'id');
    }

    public function coupon()
    {
        return $this->hasOne('App\Models\Coupons', 'coupon_code' , 'coupon_code');
    }
    
    public function partialPayment()
    {
        return $this->hasOne('App\Models\PartialPayment', 'order_id' , 'id');
    }
}
