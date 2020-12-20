<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\User;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Order;
use App\Models\AssignOrders;
use App\Models\Districts;
use App\Models\Messages;
use Carbon\Carbon;

class MessagesController extends Controller
{
 public function getMessages(Request $request){
    $messages = Messages::where('order_id', $request->order_id)->get();
    $order  = Order::where('id', $request->order_id)->with('client')->with('assigned_order')->first();
    $client = Client::where('id', $order->client_id)->first();
    $driver = Driver::where('id', $order->assigned_order->Driver_id)->first();
    
    $clientInfo = User::find($client->user_id);
    $driverInfo = User::find($driver->user_id);
     
    $response = [
        'status' => 200,
        'message' => 'success',
        'messages' => $messages,
        'order'    => $order,
        'client'   => $clientInfo,
        'driver'   => $driverInfo,
    ];

    return response()->json($response, 200);
 }
 
  public function saveMessage(Request $request){
    $message = new Messages();
    $message->text     = $request->text;
    $message->order_id = $request->order_id;
    $message->user_id  = $request->user_id;
    $message->save();
    
    $order  = Order::where('id', $request->order_id)->with('assigned_order')->first();
    $client = Client::where('id', $order->client_id)->with('user')->first();
    $driver = Driver::where('id', $order->assigned_order->Driver_id)->with('user')->first();
    
    // if the sender user_id == the client id send notification to driver
    if ($request->user_id == $client->user_id) {
        $user = User::find($driver->user_id);
        $message = $request->text; 
        $title = 'New message from '.$client->user->name;
        $player_id = $user->player_id;
        $data = ['order_id' => $request->order_id, 'screen' => 'messages'];
        if (isset($user->player_id) && $player_id != '') {
            app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title, $data);
        }
    } else {
        $user = User::find($client->user_id);
        $message = $request->text; 
        $title = 'New message from '.$driver->user->name;
        $player_id = $user->player_id;
        $data = ['order_id' => $request->order_id, 'screen' => 'messages'];
        if (isset($user->player_id) && $player_id != '') {
            app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title, $data);
        }
    }
     
    $messages = Messages::where('order_id', $request->order_id)->get();
    $response = [
        'status' => 200,
        'message' => 'success',
        'messages' => $messages,
    ];

    return response()->json($response, 200);
 }
}