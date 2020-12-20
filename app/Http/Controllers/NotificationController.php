<?php

namespace App\Http\Controllers;

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
use Reflector;

class NotificationController extends Controller
{
    //  send notification for mobile
    //  keep data array as is so the notification can be recived in app
    public function sendNtoification($player_id, $message, $title, $data = ['order_id' => '', 'screen' => ''])
    {
        $content = array(
            "en" => $message
        );
        $headings = array(
            "en" => $title
        );

        $fields = array(
            'app_id' => 'aed61a20-41f7-403b-841b-3f3774d1472f',
            "headings" => $headings,
            'include_player_ids' => array($player_id),
            // 'large_icon' => "https://www.google.co.in/images/branding/googleg/1x/googleg_standard_color_128dp.png",
            'content_available' => true,
            'contents' => $content,
            "data" => $data
        );

        $headers = array(
            'Authorization: key=**MGZlMDFlZDQtM2U5MS00MDFjLWIyMzMtNWRlZjFkOWI3YzA4**',
            'Content-Type: application/json; charset=utf-8'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
    }
    
    public function notificationOrder(Request $request)
    {
        // if(Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin')
        // {
        //     $notifications = Notifications::where('id',$request->id)->with('order')->first();
        //     $Driver = Driver::all();
        //     return view('notifications.notificationOrder',compact(['notifications','Driver']));
        // } else{
            Notifications::where('id',$request->id)->update(['is_seen' => 1]);
            $notifications = Notifications::where('id',$request->id)->with('order')->first();
            $Driver = Driver::all();
            return view('notifications.notificationOrder',compact(['notifications','Driver']));

        // }
    }
}