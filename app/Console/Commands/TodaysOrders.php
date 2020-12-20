<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Order;
use App\Models\AssignOrders;
use App\Models\Location;
use App\Models\City;
use App\Models\Districts;
use App\Models\TodayOrders;
use Carbon\Carbon;

class TodaysOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will get all today orders and store them into todayOrders table in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // empty table
        TodayOrders::truncate();
        // get all orders with delivey date of today
        $assigndOrders = AssignOrders::where('delivery_date', Carbon::now()->format('Y-m-d'))->get();
        // save orders in todayOrders table
        foreach ($assigndOrders as $assigndOrder) {
            $order = Order::find($assigndOrder->Order_id);
            $client= Client::where('id', $order->client_id)->with('user')->first();
            $driver = Driver::where('id', $assigndOrder->Driver_id)->with('user')->first();
            $region = Location::find($order->locations);
            $district = Districts::find($order->districts);
            $todayOrders = new TodayOrders();
            $todayOrders->client           =  $client->user->name;
            if (isset($driver->user->name)) {
                $todayOrders->driver       =  $driver->user->name;
            }
            $todayOrders->status           =  $order->status;
            $todayOrders->SenderNumber     =  $order->SenderNumber;
            $todayOrders->SenderName       =  $order->SenderName;
            $todayOrders->RecipientNumber  =  $order->RecipientNumber;
            $todayOrders->RecipientName    =  $order->RecipientName;
            $todayOrders->payment_status   =  $order->payment_status;
            $todayOrders->region           =  $region->Region;
            $todayOrders->city             =  $order->city;
            $todayOrders->district         =  $district->name;
            $todayOrders->RecipientAddress =  $order->RecipientAddress;
            $todayOrders->itemPrice        =  $order->itemPrice;
            $todayOrders->deliveryPrice    =  $order->deliveryPrice;
            $todayOrders->totalPrice       =  $order->totalPrice;
            $todayOrders->barcode          =  $order->barcode;
            $todayOrders->coupon_code      =  $order->coupon_code;
            $todayOrders->notes            =  $order->notes;
            $todayOrders->order_created_at =  $order->created_at;
            $todayOrders->save();
        }
        
        $this->info('orders today !');
    }
}
