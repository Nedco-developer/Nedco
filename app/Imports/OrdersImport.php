<?php

namespace App\Imports;

use App\Models\Order;
use App\Models\Client;
use App\Models\User;
use App\Models\Districts;
use App\Models\DistrictsPrices;
use App\Models\Location;
use App\Models\AssignOrders;
use App\Models\Pickedup;
use App\Models\Notifications;
use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrdersImport implements ToModel, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $data;
    public function model(array $row)
    {
        $user = User::where('phone', $row['client_phone'])->first();
        if (!isset($user->id)) {
            $this->data = ['error' => 'an error accourd , no user with the following phone number was found '.$row['client_phone']];
            return;
        }
        $districts = Districts::where('name', $row['district'])->first();
        if (!isset($districts->id)) {
            $this->data = ['error' => 'an error accourd ,'.$row['district'].' district was not found in the system!'];
            return;
        }
        $city = City::where('name',$row['city'])->first();
        $location = Location::find($city->locations);
        $client = Client::where('user_id', $user->id)->first();
        $delivery_price = DistrictsPrices::where('user_id', $client->user_id)->where('district_id', $districts->id)->select('price')->first();
        if (!isset($delivery_price->price)) {
            $price = 0;
        } else {
            $price = $delivery_price->price;
        }
        $total_price =  (float)$price + (float)$row['item_price'];
        
        $ch = curl_init();
        $searchQuery = urlencode($row['city'].",".$row['district']);
        curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?address=".$searchQuery."&key=AIzaSyD-NF4wMIb4TcsnH1Y9tBklUK-BRX5Pk8U");
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

        curl_close($ch);

        $order = new Order();
        $order->status                =         'Ready';
        $order->client_id             =         $client->id;
        if ($row['sender_number'] == '') {
            $order->SenderNumber          =         $user->phone;
        } else {
            $order->SenderNumber          =         '0'.$row['sender_number'];
        }
        if ($row['sender_number'] == '') {
            $order->SenderName            =         $user->name;
        } else {
            $order->SenderName            =         $row['sender_name'];
        }
        $order->RecipientNumber       =         '0'.$row['recipient_number'];
        $order->RecipientName         =         $row['recipient_name'];
        $order->city                  =         $row['city'];
        $order->city_id               =         $city->id;
        $order->districts             =         $districts->id;
        $order->locations             =         $location->id;
        $order->RecipientAddress      =         $row['recipient_address'];
        $order->itemPrice             =         $row['item_price'];
        $order->deliveryPrice         =         $delivery_price->price;
        $order->totalPrice            =         $total_price;
        $order->lat                   =         $lat;
        $order->lon                   =         $lon;
        $order->notes                 =         $row['notes'];
        $order->barcode               =         rand(10000, 99999);
        $order->save();
        
        $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $order->id));
        $AssignOrders->Order_id      = $order->id;
        $AssignOrders->delivery_date = date("Y-m-d", strtotime("+1 day"));
        $AssignOrders->save();
        
        $notifications = new Notifications();
        $notifications->order_id = $order->id;
        $notifications->message = "New Order To Pick up";
        $notifications->is_seen = 0;
        $notifications->type = 'pickup';
        $notifications->save();
        
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
        
        return $order;
    }
}
