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
use App\Models\Location;
use App\Models\City;
use App\Models\AssignOrders;
use App\Models\Districts;
use App\Models\DistrictsPrices;
use App\Models\Order;
use App\Models\Notifications;
use App\Models\Coupons;

class ClientController extends Controller
{
    public function Order(Request $request){
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin' || Auth::user()->type == 'client') {
            $locations = Location::all();
            $user = User::with('client')->where('id', Auth::user()->id)->first();
            return view('client.Order',compact(['locations', 'user']));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function submitOrdes(Request $request){
        if (isset($request->coupon_code) && $request->coupon_code != '') {
            $coupon = Coupons::where('coupon_code', $request->coupon_code)->first();
            if (!isset($coupon)) {
                return redirect()->back()->with('error', 'Coupon code dose not exist !')->withInput();
            }
            if ($coupon->expires_at < date('Y-m-d')) {
                return redirect()->back()->with('error', 'Coupon code expired !')->withInput();
            }

            $discount = $coupon->discount;
            $used_coupon = true;
        } else {
            $coupon = null;
            $discount = 0;
            $used_coupon = false;
        }

        $user = Auth::user();
        $Order = new Order();
        $client = Client::with('user')->where('user_id', $user->id)->first();
        $city = City::find($request->city);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?address=".$city->name.",".$request->district."&key=AIzaSyD-NF4wMIb4TcsnH1Y9tBklUK-BRX5Pk8U");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $response = curl_exec($ch);
        $resJson = json_decode($response);
        
        if ( isset($resJson->results[0]->geometry->location->lng) && isset($resJson->results[0]->geometry->location->lat) ) {
            $lat = $resJson->results[0]->geometry->location->lat;
            $lon = $resJson->results[0]->geometry->location->lng;
        } else {
            $lat = 0.000000;
            $lon = 0.000000;
        }

        $Order->status           =  'Ready';
        $Order->client_id        =  $client->id;
        $Order->SenderNumber     =  $user->phone;
        $Order->SenderName       =  $user->name;
        $Order->RecipientNumber  =  $request->Recipientnumber;
        $Order->RecipientName    =  $request->Recipientname;
        $Order->city             =  $city->city;
        $Order->city_id          =  $city->id;
        $Order->districts        =  $request->district;
        $Order->locations        =  $request->location;
        $Order->RecipientAddress =  $request->Recipientaddress;
        $Order->itemPrice        =  $request->itemprice;
        $Order->deliveryPrice    =  $request->deliveryprice;
        $Order->totalPrice       =  $request->totalprice - $discount;
        if (isset($coupon) && gettype($coupon) != 'NULL') {
            $Order->coupon_code      =  $coupon->coupon_code;
        }
        $Order->lat              =  $lat;
        $Order->lon              =  $lon;
        $Order->notes            =  $request->notes;
        $Order->barcode          =  rand(10000, 99999);
        $Order->save();
        
        $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $Order->order_id));
        $AssignOrders->Order_id      = $Order->id;
        $AssignOrders->delivery_date = date("Y-m-d", strtotime("+1 day"));
        $AssignOrders->save();
        
        $dispatchers = Dispatcher::with('user')->get();
        foreach($dispatchers as $dispatcher) {
            if (isset($dispatcher->user)) {
                $message = 'There is a new order !'; 
                $title = 'Hello '.$dispatcher->user->name;
                $player_id = $dispatcher->user->player_id;
                if (isset($dispatcher->user->player_id) && $player_id != '') {
                    app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title);
                }
            }
        }

        $notifications = new Notifications();
        $notifications->order_id = $Order->id;
        $notifications->message = " New Order need to Assign !.";
        $notifications->is_seen = 0;
		$notifications->save();
        return redirect()->back()->with('success', 'تم ارسال طلبك بنجاح ');
    }

    public function viewOrder(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin' || Auth::user()->type == 'client') {
            $client = Client::with('user')->where('user_id', auth()->id())->first();
            $Order = Order::where('client_id',$client->id)->with('coupon')->get();
            $Orderpinnding = Order::where('client_id',$client->id)->where('status','Pending')->get();
            $Orderdelivered = Order::where('client_id',$client->id)->where('status','delivered')->get();
            $Ordercancelled = Order::where('client_id',$client->id)->where('status','!=','Pending')->where('status','!=','delivered')->where('status','!=','Out For Delivery')->get();
            return view('client.viewOrder',compact('Order','Orderpinnding','Orderdelivered','Ordercancelled'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function getDeliveryPrice(Request $request)
    {
        $location = Location::where('city', $request->city)->first();

        if (is_null($location)) {
            $delivery_price = Client::where('user_id', Auth::user()->id)->select('other as delivery_price')->first();
        } else {
            $delivery_price = Client::where('user_id', Auth::user()->id)->select($location->Region . ' as delivery_price')->first();
        }
        return $delivery_price;
    }

    public function editOrder(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin' || Auth::user()->type == 'client') {
            $locations = Location::all();
            $cities = City::all();
            $districts = Districts::all();
            $user = User::with('client')->where('id', Auth::user()->id)->first();
            $order = Order::find($request->id);
            return view('client.editOrder',compact(['locations', 'cities', 'districts', 'user', 'order']));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }
    
    public function Viewclient(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin' || Auth::user()->type == 'client'|| Auth::user()->type == 'monitor'|| Auth::user()->type == 'dispatcher'|| Auth::user()->type == 'finance') {
            $user = User::with('client')->where('id', $request->id)->first();
            $Order = Order::where('client_id',$user->client->id)->with('assigned_order')->get();
            $itemPrice = Order::where('client_id',$user->client->id)->where('status','Delivered')->pluck('itemPrice')->sum();
            $deliveryPrice = Order::where('client_id',$user->client->id)->where('status','Delivered')->pluck('deliveryPrice')->sum();
            $totalPrice = Order::where('client_id',$user->client->id)->where('status','Delivered')->pluck('totalPrice')->sum();
            $count = Order::where('client_id',$user->client->id)->where('status','Delivered')->count();
            $districtsPrices = DistrictsPrices::where('user_id',$user->id)->with('Districts')->get();
            $OrderDelivered = Order::where('client_id',$user->client->id)->where('status','Delivered')->with('assigned_order')->get();
            return view('client.Viewclient',compact('OrderDelivered','user','Order','itemPrice','deliveryPrice','totalPrice','count','districtsPrices'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function updateOrder(Request $request)
    {
        $city = City::find($request->city);
        
        $Order = Order::find($request->id);            
        $client = Client::with('user')->where('user_id', Auth::user()->id)->first();
        $Order->RecipientNumber  =  $request->Recipientnumber;
        $Order->RecipientName    =  $request->Recipientname;
        $Order->RecipientAddress =  $request->Recipientaddress;
        $Order->itemPrice        =  $request->itemprice;
        $Order->deliveryPrice    =  $request->deliveryprice;
        $Order->totalPrice       =  $request->totalprice;
        $Order->notes            =  $request->notes;
        $Order->save();
        return redirect()->back()->with('success', 'تم نعديل الطلب بنجاح ');
    }
}
