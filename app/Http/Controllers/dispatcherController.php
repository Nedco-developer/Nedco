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
use App\Models\Notifications;


class dispatcherController extends Controller
{
    public function assignOrder(Request $request){
        $order = Order::find($request->get('order_id'));
        $order->status = 'Assigned';
        $order->save();
        
        $driver = Driver::where('id', $request->get('driver_id'))->with('user')->first();
        $client = Client::where('id', $order->client_id)->with('user')->first();
        
        $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $request->get('order_id')));
        $AssignOrders->Driver_id = $request->get('driver_id');
        $AssignOrders->Order_id = $request->get('order_id');
        $AssignOrders->delivery_date = $request->get('delivery_date');
        $AssignOrders->save();
        
        if ($driver) {
            $message = 'You Have a new order to deliver !'; 
            $title = 'Hello '.$driver->user->name;
            app('App\Http\Controllers\NotificationController')->sendNtoification($driver->user->player_id, $message, $title);
        }
        
        if ($client) {
            $message = "The Order Number #".$order->id." Will Be Deliverd at ".$request->get('delivery_date').".";
            $title = 'Hello '.$client->user->name;
            app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
        }
        
        $notificationsDriver = new Notifications();
        $notificationsDriver->user_id = $driver->user_id;
        $notificationsDriver->order_id = $request->get('order_id');
        $notificationsDriver->message = " New Order To Deliver ! ";
        $notificationsDriver->is_seen = 0;
		$notificationsDriver->save();
		
		$notificationsClient = new Notifications();
        $notificationsClient->user_id = $client->user_id;
        $notificationsClient->order_id = $request->get('order_id');
        $notificationsClient->message = " The Order Number #".$order->id." Will Be Deliverd at ".$request->get('delivery_date').".";
        $notificationsClient->is_seen = 0;
		$notificationsClient->save();
		
        return 'تم اختيار السائق بنجاح ';
    }
    
        public function assignMultiOrder(Request $request){
        $driver = Driver::where('id', $request->get('driver_id'))->with('user')->first();
        
        if ($driver) {
            $message = 'There are new orders to deliver'; 
            $title = 'Hello '.$driver->user->name;
            app('App\Http\Controllers\NotificationController')->sendNtoification($driver->user->player_id, $message, $title);
        }
        
        foreach($request->order_ids as $order_id){
            $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $order_id));
            $AssignOrders->Driver_id = $request->get('driver_id');
            $AssignOrders->Order_id = $order_id;
            $AssignOrders->delivery_date = $request->get('delivery_date');
            $AssignOrders->save();
            
            $order = Order::find($order_id);
            $order->status = 'Assigned';
            $order->save();
            $client = Client::where('id', $order->client_id)->with('user')->first();
            
            if ($client) {
                $message = "The Order Number #".$order->id." Will Be Deliverd at ".$request->get('delivery_date').".";
                $title = 'Hello '.$client->user->name;
                app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
            }
            
            $notificationsDriver = new Notifications();
            $notificationsDriver->user_id = $driver->user_id;
            $notificationsDriver->order_id = $order_id;
            $notificationsDriver->message = " New Order To Deliver ! ";
            $notificationsDriver->is_seen = 0;
		    $notificationsDriver->save();
		    
		    $notificationsClient = new Notifications();
            $notificationsClient->user_id = $client->user_id;
            $notificationsClient->order_id = $order_id;
            $notificationsClient->message = " The Order Number #".$order->id." Will Be Deliverd at ".$request->get('delivery_date').".";
            $notificationsClient->is_seen = 0;
		    $notificationsClient->save();   
        }
		
        return 'تم اختيار السائق بنجاح ';
    }

    public function viewOrder(Request $request){
        $Driver = Driver::with('user')->where('status','approved')->get();

        $Order = Order::all();
        $Orderpinnding = Order::where('status','Pending')->orWhere('status', 'Assigned')->with('assigned_order')->get();
        $Orderdelivered = Order::where('status','delivered')->get();
        $Ordercancelled = Order::where('status','!=','Pending')->where('status','!=','delivered')->where('status','!=','Out For Delivery')->get();
        return view('dispatcher.Order',compact('Order','Orderpinnding','Orderdelivered','Ordercancelled','Driver'));
    }

    public function ViewAllDrivers(Request $request){
        $Driver = Driver::with('user')->where('status','approved')->get();

        return view('dispatcher.ViewAllDrivers',compact('Driver'));
    }
}
