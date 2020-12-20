<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Dispatcher;
use App\Models\Finance;
use App\Models\Monitor;
use App\Models\Driver;
use App\Models\User;
use App\Models\Order;
use App\Models\AssignOrders;


class MonitorController extends Controller
{
    public function clients(Request $request)
    {
        $clients = Client::with('user')->get();

        return view('monitor.clients', compact(['clients']));
    }

    public function orders(Request $request)
    {
        $Order = Order::all();
        $Orderpinnding = Order::where('status', 'Pending')->get();
        $Orderdelivered = Order::where('status', 'delivered')->get();
        $Ordercancelled = Order::where('status', '!=', 'Pending')->where('status', '!=', 'delivered')->where('status', '!=', 'Out For Delivery')->get();
        return view('monitor.orders', compact('Order', 'Orderpinnding', 'Orderdelivered', 'Ordercancelled'));
    }

    public function assignedOrders()
    {
        $orders = AssignOrders::with('order')->with('driver')->get();
        foreach ($orders as $key => $value) {
            $driver = Driver::find($value->Driver_id);
            if(isset($driver->user_id)){
                $user = User::find($driver->user_id);
                $value->driver->name = $user->name;   
            }
        }

        return view('monitor.assignedOrders', compact(['orders']));
    }

    public function drivers(Request $request)
    {
        $Driver = Driver::with('user')->where('status','approved')->get();
        return view('monitor.drivers', compact('Driver'));
    }

    public function cheangeStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();

        return 'Status Changed Successfully';
    }
}