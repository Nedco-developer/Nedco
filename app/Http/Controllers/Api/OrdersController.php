<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\User;
use App\Models\Client;
use App\Models\Dispatcher;
use App\Models\Finance;
use App\Models\Monitor;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Order;
use App\Models\AssignOrders;
use App\Models\FinancialAccounts;
use App\Models\DistrictsPrices;
use App\Models\City;
use App\Models\Notifications;
use App\Models\OrdersLogs;
use App\Models\PartialPayment;
use App\Models\Coupons;
use Reflector;

class OrdersController extends Controller
{
    public function addOrder(Request $request)
    {
        if ($request->coupon_code != '') {
            $coupon = Coupons::where('coupon_code', $request->coupon_code)->first();
            if (!isset($coupon)) {
                $response = ['status' => 400, 'message' => 'Coupon code dose not exist !', 'success' => false];
                return response()->json($response, 200);
            }
            if ($coupon->expires_at < date('Y-m-d')) {
                $response = ['status' => 400, 'message' => 'Coupon code expired !', 'success' => false];
                return response()->json($response, 200);
            }

            $discount = $coupon->discount;
            $used_coupon = true;
        } else {
            $coupon = null;
            $discount = 0;
            $used_coupon = false;
        }
        
        $rules = [
            'deliveryprice' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = ['status' => 400, 'message' => "Sorry We Don't Deliver to your area", 'success' => false];
            return response()->json($response, 200);
        }

        try {
            $city = City::find($request->city);
            $Order = new Order();
            $client = Client::with('user')->where('user_id', auth()->id())->first();
            $Order->status           =  'Ready';
            $Order->client_id        =  $client->id;
            $Order->SenderNumber     =  $request->SenderNumber;
            $Order->SenderName       =  $request->SenderName;
            $Order->RecipientNumber  =  $request->Recipientnumber;
            $Order->RecipientName    =  $request->Recipientname;
            $Order->city             =  $city->name;
            $Order->locations        =  $request->location;
            $Order->districts        =  $request->district;
            $Order->RecipientAddress =  $request->Recipientaddress;
            $Order->itemPrice        =  $request->itemprice;
            $Order->deliveryPrice    =  $request->deliveryprice;
            $Order->totalPrice       =  $request->totalprice - $discount;
            $Order->notes            =  $request->notes;
            $request->lat == '' ? $Order->lat = 0.000000 : $Order->lat = $request->lat;
            $request->lon == '' ? $Order->lon = 0.000000 : $Order->lon = $request->lon;
            $Order->barcode          =  rand(1000, 9999);
            if (isset($coupon) && gettype($coupon) != 'NULL') {
                $Order->coupon_code      =  $coupon->coupon_code;
            }
            $Order->save();
            
            $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $request->order_id));
            $AssignOrders->Order_id      = $Order->id;
            $AssignOrders->delivery_date = date("Y-m-d", strtotime("+1 day"));
            $AssignOrders->save();
            
            $pickups = Pickedup::with('user')->where('status', 'approved')->get();
            foreach($pickups as $pickup) {
                if (isset($pickup->user)) {
                    $message = "New Order To Pick up";
                    $title = 'Hey '.$pickup->user->name;
                    $player_id = $pickup->user->player_id;
                    if (isset($pickup->user->player_id) && $player_id != '') {
                        app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title);
                    }
                }
            }

            
            $notifications = new Notifications();
            $notifications->order_id = $Order->id;
            $notifications->message = "New Order To Pick up";
            $notifications->is_seen = 0;
            $notifications->type = 'pickup';
            $notifications->save();
            
            $response = [
                'status' => 200,
                'message' => 'Order Added Seccussfully',
                'order' => $Order
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {

            if ($request->SenderNumber == '') {
                $response = ['status' => 400,'message' => "Sender Number Is Required"];
            } else if ($request->SenderName == '') {
                $response = ['status' => 400,'message' => "Sender Name Is Required"];
            } else if ($request->Recipientnumber == '') {
                $response = ['status' => 400,'message' => "Recipient Number Is Required"];
            } else if ($request->Recipientname == '') {
                $response = ['status' => 400,'message' => "Recipient Name Is Required"];
            } else if ($request->location == '') {
                $response = ['status' => 400,'message' => "Location Is Required"];
            } else if ($request->district == '') {
                $response = ['status' => 400,'message' => "District Is Required"];
            } else if ($request->city == '') {
                $response = ['status' => 400,'message' => "city Is Required"];
            } else {
                $response = ['status' => 400,'message' => $e->getMessage()];
            }

            return response()->json($response, 200);
        }
    }

    public function assignOrder(Request $request)
    {
        $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $request->order_id));
        $AssignOrders->Driver_id     = $request->driver_id;
        $AssignOrders->Order_id      = $request->order_id;
        $AssignOrders->delivery_date = $request->delivery_date;
        $AssignOrders->save();

        $order  = Order::find($request->order_id);
        $order->status = 'Assigned';
        $order->save();
        $client = Client::where('id', $order->client_id)->with('user')->first();
        $driver = Driver::with('user')->where('id',$request->driver_id)->first();
        
        $log = new OrdersLogs();
        $log->order_id = $request->order_id;
        $log->log = 'Order has Asssigned to '.$driver->user->name.' and delivery date is '.$request->delivery_date;
        $log->save();

        $user = User::find($driver->user_id);
        $message = 'You Have a new order to deliver'; 
        $title = 'Hey '.$user->name;
        $player_id = $user->player_id;
        if (isset($user->player_id) && $player_id != '') {
            app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title);
        }
        
        $message = "The Order Number #".$request->order_id." Will Be Deliverd at ".$request->get('delivery_date').".";
        $title = 'Hey '.$client->user->name;
        $player_id = $client->user->player_id;
        if (isset($user->player_id) && $player_id != '') {
            app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title);
        }

        $response = [
            'status' => 200,
            'success' => true,      
            'message' => 'Success',
        ];

        return response()->json($response, 200);
    }


    public function changeOrderStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->payment_status = $request->payment_status;
        $order->save();

        if ($request->partial_payment != '') {
            $partialPayment = new PartialPayment();
            $partialPayment->order_id = $request->id;
            $partialPayment->paid = $request->partial_payment;
            $partialPayment->save();
        }
        
        if ($request->status != 'Delivered' && $request->status != 'Out For Delivery') {
            $log = new OrdersLogs();
            $log->order_id = $request->id;
            $log->log = $request->status.' / '.$request->driverOrderNote;
            $log->save();
        }
        
        $assigndOrder = AssignOrders::where('Order_id', $request->id)->first();
        $client = Client::where('id', $order->client_id)->with('user')->first();
        $driver = Driver::where('id', $assigndOrder->Driver_id)->with('user')->first();
        $districtsPrices = DistrictsPrices::where('user_id', $driver->user_id)->where('district_id', $order->districts)->first();

        if (isset($client->user->player_id)) {
            if ($request->status == 'Cancelled') {
                $message = 'Your Order Has been Cancelled'; 
                $title = 'Hey '.$client->user->name;
                $log = new OrdersLogs();
                $log->order_id = $request->id;
                $log->log = 'Order has been Cancelled';
                $log->save();
                app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
            } else if ($request->status == 'Out Of Reach') {
                $message = 'The recipient of the order number #'.$request->id.' is out of reach'; 
                $title = 'Hey '.$client->user->name;
                $log = new OrdersLogs();
                $log->order_id = $request->id;
                $log->log = 'Recipient was out of reach';
                $log->save();
                app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
            } else if ($request->status == 'Out For Delivery') {
                $message = 'Your Order Number #'.$request->id." Is on the way"; 
                $title = 'Hey '.$client->user->name;
                $log = new OrdersLogs();
                $log->order_id = $request->id;
                $log->log = 'Order Is Out For Delivery';
                $log->save();
                app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
            } else if ($request->status == 'Picked up') {
                $log = new OrdersLogs();
                $log->order_id = $request->id;
                $log->log = 'Order Was Picked up';
                $log->save();
            } else if ($request->status == 'Pending') {
                $message = 'Your Order Number #'.$request->id." Arrived At Nedco"; 
                $title = 'Hey '.$client->user->name;
                $log = new OrdersLogs();
                $log->order_id = $request->id;
                $log->log = 'Order Arrived At Nedco';
                $log->save();
                
                $notifications = new Notifications();
                $notifications->order_id = $Order->id;
                $notifications->message = "New Order To Assign";
                $notifications->is_seen = 0;
                $notifications->type = 'dispatcher';
                $notifications->save();
                app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
            }
        }

        switch ($request->payment_status) {
            case 'Paid Full Amount':
                $financialClient = new FinancialAccounts();
                $financialClient->user_id = $client->user_id;
                if ($request->status == 'Delivered') {
                    $financialClient->price = $order->itemPrice;
                } else {
                    $financialClient->price = 0;
                }
                $financialClient->save();

                $financialDriver = new FinancialAccounts();
                $financialDriver->user_id = $driver->user_id;
                $financialDriver->price = $districtsPrices->price;
                $financialDriver->save();
                
                $notificationsDriver = new Notifications();
                $notificationsDriver->user_id = $client->user_id;
                $notificationsDriver->order_id = $request->id;
                if ($request->status == 'Cancelled') {
                    $notificationsDriver->message = "Your Order has been Cancelled";
                } else {
                    $notificationsDriver->message = "Your Order has been Arrived ,And Has Paid Full Amount.";
                    $log = new OrdersLogs();
                    $log->order_id = $request->id;
                    $log->log = 'Order has been Delivered';
                    $log->save();
                }
                $notificationsDriver->is_seen = 0;
        		$notificationsDriver->save();
        		
                break;
            case 'Paid Only Delivery Costs':
                $financialClient = new FinancialAccounts();
                $financialClient->user_id = $client->user_id;
                $financialClient->price = 0;
                $financialClient->save();

                $financialDriver = new FinancialAccounts();
                $financialDriver->user_id = $driver->user_id;
                $financialDriver->price = $districtsPrices->price;
                $financialDriver->save();

                $notificationsDriver = new Notifications();
                $notificationsDriver->user_id = $client->user_id;
                $notificationsDriver->order_id = $request->id;
                if ($request->status == 'Cancelled') {
                    $notificationsDriver->message = "Your Order has been Cancelled";
                } else {
                    $notificationsDriver->message = "Your Order has been Arrived ,And Paid Only Delivery Costs.";
                    $log = new OrdersLogs();
                    $log->order_id = $request->id;
                    $log->log = 'Order has been Delivered ,And Paid Only Delivery Costs.';
                    $log->save();
                }
                $notificationsDriver->is_seen = 0;
        		$notificationsDriver->save();
        		
                break;
            case 'Nothing Was Paid':
                $financialClient = new FinancialAccounts();
                $financialClient->user_id = $client->user_id;
                $financialClient->price = '-'.$order->deliveryPrice;
                $financialClient->save();
    
                $financialDriver = new FinancialAccounts();
                $financialDriver->user_id = $driver->user_id;
                $financialDriver->price = $districtsPrices->price;
                $financialDriver->save();
                
                $notificationsDriver = new Notifications();
                $notificationsDriver->user_id = $client->user_id;
                $notificationsDriver->order_id = $request->id;
                if ($request->status == 'Cancelled') {
                    $notificationsDriver->message = "Your Order has been Cancelled";
                } else {
                    $notificationsDriver->message = "Your Order has been Arrived ,And Nothing Was Paid.";
                    $log = new OrdersLogs();
                    $log->order_id = $request->id;
                    $log->log = 'Order has been Delivered ,And Nothing Was Paid.';
                    $log->save();
                }
                $notificationsDriver->is_seen = 0;
        		$notificationsDriver->save();
                break;
            default:
                # code...
                break;
        }

        $response = [
            'status' => 200,
            'message' => 'Order Status Changed Successfully ',
        ];

        return response()->json($response, 200);
    }
    
    public function changePickUpOrderStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->payment_status = $request->payment_status;
        $order->save();
        
        $client = Client::where('id', $order->client_id)->with('user')->first();

        if (isset($client->user->player_id)) {
            if ($request->status == 'Picked up') {
                $log = new OrdersLogs();
                $log->order_id = $request->id;
                $log->log = 'Picked up';
                $log->save();
            } else if ($request->status == 'Pending') {
                $message = 'Your Order Number #'.$request->id." Arrived At Nedco"; 
                $title = 'Hey '.$client->user->name;
                $log = new OrdersLogs();
                $log->order_id = $request->id;
                $log->log = 'Order Arrived At Nedco';
                $log->save();
                
                $dispatchers = Dispatcher::with('user')->where('status', 'approved')->get();
                foreach($dispatchers as $dispatcher) {
                    if (isset($dispatcher->user)) {
                        $message = "New Order To Pick up";
                        $title = 'Hey '.$dispatcher->user->name;
                        $player_id = $dispatcher->user->player_id;
                        if (isset($dispatcher->user->player_id) && $player_id != '') {
                            app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title);
                        }
                    }
                }

                
                $notifications = new Notifications();
                $notifications->order_id = $order->id;
                $notifications->message = "New Order To Assign";
                $notifications->is_seen = 0;
                $notifications->type = 'dispatcher';
                $notifications->save();
                app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
            }
        }

        $response = [
            'status' => 200,
            'message' => 'Order Status Changed Successfully ',
        ];

        return response()->json($response, 200);
    }

    public function getSingleOrder(Request $request)
    {
        $order = Order::with('assigned_order')->where('id', $request->order_id)->first();
        
        $order_logs = OrdersLogs::where('order_id', $request->order_id)->get();

        if (isset($order->assigned_order->Driver_id)){
            $driver = Driver::with('user')->where('id', $order->assigned_order->Driver_id)->first();
            $assigned_order = true;
        } else {
            $driver = null;
            $assigned_order = false;
        }

        $response = [
            'status'  => 200,
            'message' => 'Success',
            'order'   => $order,
            'driver'  => $driver,
            'assigned_order' => $assigned_order,
            'order_logs' => $order_logs
        ];

        return response()->json($response, 200);        
    }
    
    public function getSingleOrderByBarcod(Request $request)
    {
        $order = Order::with('assigned_order')->where('barcode', $request->barcode)->first();
        
        $order_logs = OrdersLogs::where('order_id', $request->order_id)->get();

        if (isset($order->assigned_order)){
            $driver = Driver::with('user')->where('id', $order->assigned_order->Driver_id)->first();
            $response = [
                'status'  => 200,
                'message' => 'Success',
                'order'   => $order,
                'driver'  => $driver,
                'order_logs' => $order_logs
            ];
            return response()->json($response, 200); 
        } else {
            $driver = null;
            $response = [
                'status'  => 400,
                'message' => 'Success',
                'order'   => $order,
                'driver'  => $driver,
                'order_logs' => $order_logs
            ];
            return response()->json($response, 200); 
        }
    }
}
