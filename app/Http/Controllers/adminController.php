<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Client;
use App\Models\Dispatcher;
use App\Models\Finance;
use App\Models\Monitor;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Order;
use App\Models\City;
use App\Models\Districts;
use App\Models\DistrictsPrices;
use App\Models\AssignOrders;
use App\Models\Notifications;
use App\Models\Pickedup;
use Illuminate\Support\Facades\Validator;
use App\Models\Coupons;
use App\Models\OrdersLogs;
use App\Models\LocationsPrices;
use App\Models\CitiesPrices;
use Carbon\Carbon;
use DB;
use  Milon\Barcode\Facades\DNS1DFacade;

class adminController extends Controller
{
    public function RegisterAdmin()
    {
        $user = User::find(Auth::user()->id);
        if ($user->type == 'super_admin') {
            return view('admin.register-admin');
        }
        return view('home');
    }

    public function SubmitRegisterAdmin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users','max:255'],
            'type' => ['required','max:255'],
        ]);
    
        $user = new User();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->type  = $request->type;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->save();

        return redirect()->back()->with('success', 'Admin Added successfully');
    }

    public function admin(Request $request)
    {
        if (Auth::user()->type !== 'super_admin') {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
        $Admin = Admin::with('user')->get();
        return view('admin.admin', compact('Admin'));
    }

    public function deleteadmin(Request $request)
    {
        Admin::find($request->get('id'))->delete();
        User::find($request->get('user_id'))->delete();
        return redirect()->back()->with('error', 'Admin deleted successfully');
    }

    public function editadmin(Request $request)
    {
        if (Auth::user()->type !== 'super_admin') {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
        $Admin = Admin::where('user_id', $request->get('id'))->first();
        $User = User::where('id', $request->get('id'))->first();
        return view('admin.editadmin', compact('Admin', 'User'));
    }

    public function SubmitEditAdmin(Request $request)
    {
        $user = User::find($request->get('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if (isset(request()->type)) {
            request()->validate([
                $user->type = $request->input('type')
            ]);
        }

        $user->save();

        $admin = Admin::find($request->get('user_id'));
        $admin->phone = $request->input('phone');
        $admin->save();
        return redirect('admin')->with('success', 'Admin Edit successfully');
    }

    public function client(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = Client::with('user')->get();
            return view('client.client', compact('Admin'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function deleteclient(Request $request)
    {
        Client::find($request->get('id'))->delete();
        Order::where('client_id' ,$request->get('id'))->delete();
        User::find($request->get('user_id'))->delete();
        return redirect()->back()->with('error', 'client deleted successfully');
    }

    public function editclient(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = client::where('user_id', $request->get('id'))->first();
            $User = User::where('id', $request->get('id'))->first();
            return view('client.editclient', compact('Admin', 'User'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }
    
    public function registerUser(Request $request)
    {
        return view('admin.AddUser');
    }

    public function viewAllUsers(Request $request)
    {
        $users = User::all();
        return view('admin.viewAllUsers', compact('users'));
    }
    
    public function location_prices(Request $request)
    {
        $locations = Location::all();
        $user_id = $request->id;
        
        foreach($locations as $location){
            $locationsPrices = LocationsPrices::where('user_id', $user_id)->where('location_id', $location->id)->first();
            if (isset($locationsPrices)) {
                $location->price = $locationsPrices->price;
            } else {
                $location->price = null;
            }
        }
        
        $districtsPrices = DistrictsPrices::all();
        $districts = Districts::all();
        
        return view('admin.Locations_prices', compact('locations', 'user_id', 'districtsPrices', 'districts'));
    }
    
    public function cities_prices(Request $request)
    {
        $cities = City::where('locations', $request->id)->get();
        $user_id = $request->user_id;

        return view('admin.cities_prices', compact('cities', 'user_id'));
    }
    
    public function districts_prices(Request $request)
    {
        $districts = Districts::where('city_id', $request->id)->get();
        $userDistricts = DistrictsPrices::where('user_id', $request->user_id)->get();

        // return $userDistricts;
        $user_id = $request->user_id;
        return view('admin.districts_prices', compact('districts', 'user_id', 'userDistricts'));
    }
    
    public function submitDistrictsPrices(Request $request)
    {

        foreach($request->all() as $key => $value) {

            if ($key == 0) {
                continue;
            }
            
            $districtsPrciese = DistrictsPrices::updateOrCreate(
                ['user_id' =>  $request->user_id, 'district_id' => $key],
                ['price' => $value]
            );
        }
        
        return back();
    }
    
     public function RegisterByAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|max:255',
        ]);
        
        $status = 'pending';
        if (Auth::user()) {
            if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
                $status = 'approved';
            }
        }
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->type = $request->get('type');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        
        if($request->get('type') == 'client')
        {
            $client = new Client();
            $client->user_id = $user->id;
            $client->address = $request->address;
            $client->status =  'approved';
            $client->save();
            
            return redirect()->route('location-prices', $user->id);
        }
        elseif($request->get('type') == 'driver')
        {
            $driver = new Driver();
            $driver->user_id = $user->id;
            $driver->address = $request->address;
            $driver->status =  $status;
            $driver->save();
            
            return redirect()->route('location-prices', $user->id);
        }
        elseif($request->get('type') == 'finance')
        {
            $finance = new Finance();
            $finance->user_id = $user->id;
            $finance->address = $request->address;
            $finance->status =  $status;
            $finance->save();
        }
        elseif($request->get('type') == 'dispatcher')
        {
            $dispatcher = new Dispatcher();
            $dispatcher->user_id = $user->id;
            $dispatcher->address = $request->address;
            $dispatcher->status =  $status;
            $dispatcher->save();
        }
        elseif($request->get('type') == 'monitor')
        {
            $monitor = new Monitor();
            $monitor->user_id = $user->id;
            $monitor->address = $request->address;
            $monitor->status =  $status;
            $monitor->save();
        }
        elseif($request->get('type') == 'pickup')
        {
            $monitor = new Pickedup();
            $monitor->user_id = $user->id;
            $monitor->address = $request->address;
            $monitor->status =  $status;
            $monitor->save();
        }
        return back()->with('success', 'User Was Added');
    }

    public function SubmitEditall(Request $request)
    {
        $user = User::find($request->user_id);
        $user->name   =  $request->name;
        $user->email  =  $request->email;
        $user->phone  =  $request->phone;
        if (isset(request()->type)) {
            request()->validate([
                $user->type = $request->type
            ]);
        }
        $user->save();

        if ($request->type == 'client') {
            $admin = Client::find($request->id);
            $admin->address  =   $request->address;
            $admin->status   =  'approved';
            $admin->save();
            return redirect()->route('location-prices', $user->id);
            // return redirect('client')->with('success', 'Client Edit successfully');
        } elseif ($request->type == 'driver') {
            $admin = Driver::find($request->id);
            $admin->address =  $request->address;
            $admin->status  =  $request->status;
            $admin->save();
            return redirect()->route('location-prices', $user->id);
            // return redirect('driver')->with('success', 'Driver Edit successfully');
        } elseif ($request->type == 'finance') {
            $admin = Finance::find($request->get('id'));
            $admin->address =  $request->address;
            $admin->status  =  $request->status;
            $admin->save();

            return redirect('finance')->with('success', 'Finance Edit successfully');
        } elseif ($request->type == 'dispatcher') {
            $admin = Dispatcher::find($request->get('id'));
            $admin->address =  $request->address;
            $admin->status  =  $request->status;
            $admin->save();

            return redirect('dispatcher')->with('success', 'Dispatcher Edit successfully');
        } elseif ($request->type == 'monitor') {
            $admin = Monitor::find($request->id);
            $admin->address =  $request->address;
            $admin->status  =  $request->status;
            $admin->save();

            return redirect('monitor')->with('success', 'Monitor Edit successfully');
        }elseif($request->get('type') == 'pickup')
        {
            $monitor = Pickedup::find($request->id);
            $monitor->user_id = $user->id;
            $monitor->address = $request->address;
            $monitor->status =  $request->status;
            $monitor->save();
            
            return back()->with('success', 'Pickup Edited successfully');
        }
    }

    public function driver(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = Driver::with('user')->get();
            // return $Admin;
            return view('driver.driver', compact('Admin'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function editdriver(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = driver::where('user_id', $request->get('id'))->first();
            $User = User::where('id', $request->get('id'))->first();
            return view('driver.editDriver', compact('Admin', 'User'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function deletedriver(Request $request)
    {
        driver::find($request->get('id'))->delete();
        User::find($request->get('user_id'))->delete();
        return redirect()->back()->with('error', 'Driver deleted successfully');
    }

    public function finance(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = Finance::where('status', 'approved')->get();
            foreach ($Admin as $UserAdmin) {
                $user = User::find($UserAdmin->user_id);
                $UserAdmin->name = $user->name;
                $UserAdmin->email = $user->email;
                $UserAdmin->type = $user->type;
            }
            return view('finance.finance', compact('Admin'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function editfinance(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = Finance::where('user_id', $request->get('id'))->first();
            $User = User::where('id', $request->get('id'))->first();
            return view('finance.editFinance', compact('Admin', 'User'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function deletefinance(Request $request)
    {
        Finance::find($request->get('id'))->delete();
        User::find($request->get('user_id'))->delete();
        return redirect()->back()->with('error', 'Finance deleted successfully');
    }

    public function dispatcher(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = Dispatcher::with('user')->get();
            return view('dispatcher.dispatcher', compact('Admin'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function editdispatcher(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = dispatcher::where('user_id', $request->get('id'))->first();
            $User = User::where('id', $request->get('id'))->first();
            return view('dispatcher.editDispatcher', compact('Admin', 'User'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function deletedispatcher(Request $request)
    {
        dispatcher::find($request->get('id'))->delete();
        User::find($request->get('user_id'))->delete();
        return redirect()->back()->with('error', 'dispatcher deleted successfully');
    }

    public function monitor(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = monitor::with('user')->get();
            return view('monitor.monitor', compact('Admin'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function editmonitor(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Admin = monitor::where('user_id', $request->get('id'))->first();
            $User = User::where('id', $request->get('id'))->first();
            return view('monitor.editMonitor', compact('Admin', 'User'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function deletedmonitor(Request $request)
    {
        monitor::find($request->get('id'))->delete();
        User::find($request->get('user_id'))->delete();
        return redirect()->back()->with('error', 'monitor deleted successfully');
    }

    public function addlocation(Request $request) //open page
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            return view('admin.Locations');
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function SubmitLocation(Request $request) //add function
    {
        $Location = new Location();
        $Location->Region = $request->Region;
        $Location->price = $request->price;
        $Location->driver_price = $request->driver_price;
        $Location->save();
        return redirect()->back()->with('success', 'Location Added successfully');
    }

    public function location(Request $request) //view all locations
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Location = Location::all();
            $City = City::all();
            $Districts = Districts::all();
            return view('admin.ViewLocations', compact('Location','City','Districts'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function deleteLocation(Request $request)
    {
        Location::find($request->get('id'))->delete();
        return redirect()->back()->with('error', 'Location deleted successfully');
    }

    public function editLocation(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Location = Location::where('id', $request->get('id'))->first();
            return view('admin.EditLocation', compact('Location'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function SubmitEditLocation(Request $request)
    {
        $Location = Location::find($request->id);
        $Location->Region = $request->Region;
        $Location->price = $request->price;
        $Location->driver_price = $request->driver_price;
        $Location->save();
        $success = 'Location Editing successfully';
        $Location = Location::all();
        $City = City::all();
        $Districts = Districts::all();
        return view('admin.ViewLocations', compact('Location','City','Districts'));
    }

    public function viewAllOrders(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Driver = Driver::with('user')->where('status','approved')->get();
            $Order = Order::with('assigned_order')->with('cancelledOrder')->with('coupon')->orderBy('id', 'desc')->get();
            $itemP = array();
            $deliveryP = array();
            $totalP = array();
            foreach($Order as $order){
                array_push($itemP,$order->itemPrice);
                array_push($deliveryP,$order->deliveryPrice);
                array_push($totalP,$order->totalPrice);
            }
            $itemPrice = array_sum($itemP);
            $deliveryPrice = array_sum($deliveryP);
            $totalPrice = array_sum($totalP);
            if ($request->has('city') && isset($request->city)) {
                $Order = $Order->whereIn('city' , $request->city);
            }
            $City = City::all();
            return view('admin.viewAllOrders', compact('Order','City','Driver','itemPrice','deliveryPrice','totalPrice'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }
    
    public function requestAllLocations(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $orders = Order::with('assigned_order')->where('confirm_location_sent', '0')->orderBy('id', 'desc')->get();
            $all_orders = [];
            foreach($orders as $order) {
                if (isset($order->assigned_order->delivery_date)) {
                    if (strtotime($order->assigned_order->delivery_date) > strtotime(Carbon::now()->format('Y-m-d'))) {
                        array_push($all_orders, $order);
                    }
                }
            }
            return view('admin.RequestAll', compact('all_orders'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function addMultipleOrder(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $locations = Location::all();
            $City = City::all();
            $Districts = Districts::all();
            $clients = Client::with('user')->get();
            $last_id = Order::latest()->select('id')->first();
            $DistrictsOutput = '';

            $last_id_number = (int)$last_id->id + 1;
            
            foreach($Districts as $District) {
                $DistrictsOutput .= '<option value="'. $District->id .'"  data-id=' . $last_id_number .  '>'. $District->name.'</option>';
            }

            $htmlDistricts = '
                <select required name="district" id="district_'. $last_id_number .'" class="district form-control select2">
                    <option value="">-- Choose District --</option>
                        ' . $DistrictsOutput . '
                </select>
            ';

            $clientsOutput = '';
            foreach($clients as $client) {
                $clientsOutput .= '<option value="'. $client->id .'">'. $client->user->name.'</option>';
            }

            $htmlClients = '
                <select required name="client_id" id="client_id_'. $last_id_number .'" class="clients form-control select2">
                    <option value="">-- Choose Client --</option>
                        ' . $clientsOutput . '
                </select>
            ';

            return view('admin.addOrdersTables', compact(['clients', 'locations','City','Districts', 'htmlClients', 'htmlDistricts', 'last_id']));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function addOrder(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $locations = Location::all();
            $City = City::all();
            $Districts = Districts::all();
            $clients = Client::with('user')->get();
            $last_id = Order::latest()->select('id')->first();
            $DistrictsOutput = '';

            return view('admin.addOrder', compact(['clients', 'locations','City','Districts',]));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }
    
    public function getcity(Request $request)
    {
        $loc = $request->_token;
        $cities = City::where('locations', $loc)->get();
        
        foreach($cities as $city){
            $citiesPrices = CitiesPrices::where('user_id', $request->user_id)->where('city_id', $city->id)->first();
            if (isset($citiesPrices)) {
                $city->price = $citiesPrices->price;
            } else {
                $city->price = null;
            }
        }
        return $cities;
    }
    
    public function getdistricts(Request $request)
    {
        $loc = $request->_token;
        $distrcits = Districts::where('city_id', $loc)->get();
        return $distrcits;
    }
    
    public function getAllClients(Request $request)
    {
        $clients = client::with('user')->get();
        return $clients;
    }

    public function getAllDistricts(Request $request)
    {
        $distrcits = Districts::all();
        return $distrcits;
    }
    
    public function getUserDistrict(Request $request)
    {
        $loc = $request->_token;
        
        $distrcitsPrices = DB::table('districts')
            ->leftjoin('districts_prices as d', 'd.district_id', '=', 'districts.id')
            ->where('districts.city_id', $loc)
            ->where('d.user_id', $request->user_id)
            ->select('districts.id', 'districts.name','d.price')
            ->get();
            
        if (count($distrcitsPrices) > 0) {
            return $distrcitsPrices;   
        } else {
            $distrcits = Districts::with('districts_prices')->where('city_id', $loc)->select('id', 'name')->get();
            return $distrcits;   
        }
    }

    public function getDeliveryPrice(Request $request)
    {
        $client = Client::find($request->client);
        $delivery_price = DistrictsPrices::where('user_id', $client->user_id)->where('district_id', $request->district)->select('price')->first();
        
        return $delivery_price;
    }

    public function getDeliveryPrice2(Request $request)
    {
        $delivery_price = DistrictsPrices::where('district_id', $request->district)->select('price')->first();
        
        return $delivery_price;
    }
    
    public function getClientDeliveryPrice(Request $request)
    {
        $delivery_price = DistrictsPrices::where('user_id', Auth::id())->where('district_id', $request->district)->select('price')->first();
        
        return $delivery_price;
    }

    public function submitAddOrderFromTable(Request $request)
    {
        $distrcit = Districts::find($request->district);
        $city = City::find($distrcit->city_id);
        $location = Location::find($city->locations);

        $Order = new Order();
        $client = Client::with('user')->where('id', $request->client_id)->first();
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?address=".$request->city.",".$request->district."&key=AIzaSyD-NF4wMIb4TcsnH1Y9tBklUK-BRX5Pk8U");
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
        $Order->SenderNumber     =  $client->user->phone;
        $Order->SenderName       =  $client->user->name;
        $Order->city             =  $city->name;
        $Order->city_id          =  $city->id;
        $Order->locations        =  $location->id;
        $Order->RecipientNumber  =  $request->Recipientnumber;
        $Order->RecipientName    =  $request->Recipientname;
        $Order->districts        =  $request->district;
        $Order->RecipientAddress =  $request->Recipientaddress;
        $Order->itemPrice        =  $request->itemprice;
        $Order->deliveryPrice    =  $request->deliveryprice;
        $Order->totalPrice       =  $request->totalprice;
        $Order->lat              =  $lat;
        $Order->lon              =  $lon;
        $Order->notes            =  $request->notes;
        $Order->barcode          =  rand(10000, 99999);
        $Order->save();
        
        $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $Order->order_id));
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
        
        return $Order;
    }


    public function submitAddOrder(Request $request)
    {
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

        $Order = new Order();
        $client = Client::with('user')->where('id', $request->client_id)->first();
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
        $Order->SenderNumber     =  $client->user->phone;
        $Order->SenderName       =  $client->user->name;
        $Order->RecipientNumber  =  $request->Recipientnumber;
        $Order->RecipientName    =  $request->Recipientname;
        $Order->city             =  $city->name;
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
        
        $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $Order->id));
        $AssignOrders->Order_id      = $Order->id;
        $AssignOrders->delivery_date = date("Y-m-d", strtotime("+1 day"));
        $AssignOrders->save();
        
        $dispatchers = Dispatcher::with('user')->where('status', 'approved')->get();
        foreach($dispatchers as $dispatcher) {
            if (isset($dispatcher->user)) {
                $message = 'There is a new order !'; 
                $title = 'Hey '.$dispatcher->user->name;
                $player_id = $dispatcher->user->player_id;
                if (isset($dispatcher->user->player_id) && $player_id != '') {
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
        
        return redirect()->back()->with('success', 'Order Added Successfully ');
    }

    public function editOrder(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin' || Auth::user()->type == 'client') {
            $user = User::with('client')->where('id', Auth::user()->id)->first();
            $locations = Location::all();
            $cities = City::all();
            $districts = Districts::all();
            $order = Order::find($request->id);
            return view('client.Order',compact(['locations', 'cities', 'districts', 'user', 'order']));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function updateOrder(Request $request)
    {
            $Order = Order::find($request->id);            
            $client = Client::with('user')->where('id', $request->client_id)->first();
            $Order->status           =  'Pending';
            $Order->client_id        =  $client->id;
            $Order->SenderNumber     =  $client->user->phone;
            $Order->SenderName       =  $client->user->name;
            $Order->RecipientNumber  =  $request->Recipientnumber;
            $Order->RecipientName    =  $request->Recipientname;
            $Order->city             =  $request->city;
            $Order->districts        =  $request->district;
            $Order->locations        =  $request->location;
            $Order->RecipientAddress =  $request->Recipientaddress;
            $Order->itemPrice        =  $request->itemprice;
            $Order->deliveryPrice    =  $request->deliveryprice;
            $Order->totalPrice       =  $request->totalprice;
            $Order->lon              =  $request->lon;
            $Order->lat              =  $request->lat;
            $Order->notes            =  $request->notes;
            $Order->save();
            return redirect()->back()->with('success', 'Order Edit Successfully');
    }
    
        public function ViewDetailsOrder(Request $request)
        {
        $Order = Order::where('id',$request->id)->with('cancelledOrder')->with('coupon')->with('partialPayment')->first();   
        $Admin = Client::where('id',$Order->client_id)->with('user')->first();//Get Client by order
        $assignOrders = AssignOrders::where('Order_id',$Order->id)->first();

        if (isset($assignOrders->Driver_id)) {
            $Driver = Driver::where('id',$assignOrders->Driver_id)->with('user')->first();
            $districtsPrices = DistrictsPrices::where('user_id',$Driver->user_id)->where('district_id',$Order->districts)->first();

            if (isset($districtsPrices->price)) {
                $Totalnet = (int)$Order->totalPrice - $districtsPrices->price;
            } else {
                $Totalnet = null;
            }
        } else {
            $Driver = null;
            $districtsPrices = null;
            $Totalnet = null;
        }
        
        return view('admin.View-Details-Order', compact('Admin','Order','Driver','assignOrders','Totalnet','districtsPrices'));
        }
        
        public function EditMyProfile(Request $request){
            $address = "";
        if (Auth::user()->type == 'client') {
            $User = User::where('id',$request->id)->with('client')->first();
            $address = $User->client->address;

        } elseif (Auth::user()->type == 'driver') {
            $User = User::where('id',$request->id)->with('driver')->first();
            $address = $User->driver->address;

        } elseif (Auth::user()->type == 'finance') {
            $User = User::where('id',$request->id)->with('finance')->first();
            $address = $User->finance->address;

        } elseif (Auth::user()->type == 'dispatcher') {
            $User = User::where('id',$request->id)->with('dispatcher')->first();
            $address = $User->dispatcher->address;

        } elseif (Auth::user()->type == 'monitor') {
            $User = User::where('id',$request->id)->with('monitor')->first();
            $address = $User->monitor->address;

        } elseif (Auth::user()->type == 'admin') {
            $User = User::where('id',$request->id)->with('admin')->first();
            $address = "";

        }elseif (Auth::user()->type == 'super_admin') {
            $User = User::where('id',$request->id)->with('admin')->first();
            $address = "";

        } elseif (Auth::user()->type == 'pickup') {
            $User = User::where('id',$request->id)->with('pickup')->first();
            $address = $User->pickup->address;

        }
            return view('admin.EditMyProfile',compact('User','address'));
        }
        
        public function SubmitEditallprofile(Request $request)
        {
            $rules = [
                'email' => 'required|email|max:255',
            ];
    
            $emailRules = [
                'email' => 'unique:users',
            ];
    
            $validator = Validator::make($request->all(), $rules);
            $UniqueEmailValidator = Validator::make($request->all(), $emailRules);
            if ($validator->fails()) {
                 return back()->with('error', 'Email should be in a valid Format Ex: email@something.something');
            } elseif ($UniqueEmailValidator->fails()) {
                return back()->with('error', 'Email Already Exist');
            }
        
            $user = User::where('id', Auth::id())->first();
            if ($request->name != '' && $request->name != $user->name) {
                $user->name   =  $request->name;
            }
            if ($request->email != '' && $request->email != $user->email) {
                $user->email   =  $request->email;
            }
            if ($request->phone != '' && $request->phone != $user->phone) {
                $user->phone   =  $request->phone;
            }
            $user->save();
                
            if (Auth::user()->type == 'client') {
                $client = Client::where('user_id',$user->id)->first();
                $client->address = $request->address;
                if ($request->address != '' && $request->address != $client->address) {
                    $client->address   =  $request->address;
                }
                $client->save();
    
            } elseif (Auth::user()->type == 'driver') {
                $driver = Driver::where('user_id',$user->id)->first();
                if ($request->address != '' && $request->address != $driver->address) {
                    $driver->address   =  $request->address;
                }
                $driver->save();
    
            } elseif (Auth::user()->type == 'finance') {
                $finance = Finance::where('user_id',$user->id)->first();
                if ($request->address != '' && $request->address != $finance->address) {
                    $finance->address   =  $request->address;
                }
                $finance->save();
    
            } elseif (Auth::user()->type == 'dispatcher') {
                $dispatcher = Dispatcher::where('user_id',$user->id)->first();
                if ($request->address != '' && $request->address != $dispatcher->address) {
                    $dispatcher->address   =  $request->address;
                }
                $dispatcher->save();
                
            } elseif (Auth::user()->type == 'monitor') {
                $monitor = Monitor::where('user_id',$user->id)->first();
                if ($request->address != '' && $request->address != $monitor->address) {
                    $monitor->address   =  $request->address;
                }
                $monitor->save();
    
            }
            return redirect()->back()->with('success', 'Editing Successfully');
        }
        
    public function view_requests(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $Dispatcher = Dispatcher::with('user')->where('status', 'pending')->orderBy('created_at', 'desc')->get();

            $Finance = Finance::with('user')->where('status', 'pending')->orderBy('created_at', 'desc')->get();

            $Monitor = Monitor::with('user')->where('status', 'pending')->orderBy('created_at', 'desc')->get();

            $Driver = Driver::with('user')->where('status', 'pending')->orderBy('created_at', 'desc')->get();

            $Pickedup = Pickedup::with('user')->where('status', 'pending')->orderBy('created_at', 'desc')->get();
            
            return view('admin.adminhome', compact('Driver', 'Monitor', 'Finance', 'Dispatcher','Pickedup'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }
  
    public function view_pickups(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $pickups = Pickedup::with('user')->get();

            return view('pickups.view_pickups', compact('pickups'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function view_coupon_codes(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            $coupons = Coupons::all();

            return view('admin.coupons', compact('coupons'));
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function add_coupon(Request $request)
    {
        if (Auth::user()->type == 'super_admin' || Auth::user()->type == 'admin') {
            return view('admin.add_coupon');
        } else {
            return '404 YOU DONT HAVE ACCESS TO THIS ROUTE';
        }
    }

    public function submit_add_coupon(Request $request)
    {
        $coupon = new Coupons();
        $coupon->coupon_code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->expires_at = $request->expires_at;
        $coupon->save();

        return back()->with('success', 'Coupon Code Added');
    }

    public function delete_coupon(Request $request)
    {
        $coupon = Coupons::find($request->coupone_id);
        if ($coupon) {
            $coupon->delete();
            return ['success' => true, 'id' => $request->coupone_id];
        }
        return ['success' => false, 'id' => 0];
    }
    
    public function scannerDispatch(Request $request)
    {
        // $drivers = Driver::with('user')->where('status','approved')->get();
        
        $users = User::where('type','driver')
            ->orWhere('type','dispatcher')
            ->orWhere('type','pickup')
            ->get();
        
        return view('admin.dispatch', compact('users'));
    }
    
    public function dispatchOrder(Request $request)
    {
        $order = Order::where('barcode', $request->barcode)->with('assigned_order')->first();

        if (!isset($order->barcode)) {
            return 'not_found';
        }
        
        if ($request->barcode == '') {
            return;
        }
        
        if ($request->status == 'Assign') {
            $order = Order::where('barcode', $request->barcode)->with('assigned_order')->first();
            
            Order::where('barcode', $request->barcode)->update([
                'status' => 'Assigned'
            ]);
            
            $client = Client::where('id', $order->client_id)->with('user')->first();
            $driver = Driver::with('user')->where('user_id', $request->user_id)->first();
            
            $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $order->id));
            $AssignOrders->Driver_id = $driver->id;
            $AssignOrders->Order_id = $order->id;
            $AssignOrders->delivery_date = $request->delivery_date;
            $AssignOrders->save();
            
            $log = new OrdersLogs();
            $log->order_id = $order->id;
            $log->log = 'Order has Asssigned to '.$driver->user->name.' and delivery date is '.$request->delivery_date;
            $log->save();
    
            $user = User::find($driver->user_id);
            $player_id = $user->player_id;
            if (isset($user->player_id) && $player_id != '') {
                $message = 'You Have a new order to deliver'; 
                $title = 'Hey '.$user->name;
            
                $notifications = new Notifications();
                $notifications->order_id = $order->id;
                $notifications->user_id = $user->id;
                $notifications->message = $message;
                $notifications->is_seen = 0;
		        $notifications->save();
                app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title);
            }
            
            $player_id = $client->user->player_id;
            if (isset($client->user->player_id) && $player_id != '') {
                $message = "The Order Number #".$order->id." Will Be Deliverd at ".$request->delivery_date.".";
                $title = 'Hey '.$client->user->name;
            
                $notifications = new Notifications();
                $notifications->order_id = $order->id;
                $notifications->user_id = $client->user->id;
                $notifications->message = $message;
                $notifications->is_seen = 0;
		        $notifications->save();
                app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title);
            }
            
            return $order;
        } else if ($request->status == 'Delivered') {
            $order = Order::where('barcode', $request->barcode)->with('assigned_order')->first();
            
            Order::where('barcode', $request->barcode)->update([
                'status' => $request->status
            ]);
            
            return $order;
        } else if ($request->status == 'Pending') {
            $order = Order::where('barcode', $request->barcode)->with('assigned_order')->first();
            
            Order::where('barcode', $request->barcode)->update([
                'status' => $request->status
            ]);
            
            $client = Client::where('id', $order->client_id)->with('user')->first();
            
            $message = 'Your Order Number #'.$order->id." Arrived At Nedco"; 
            $title = 'Hey '.$client->user->name;
            app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
            
            $log = new OrdersLogs();
            $log->order_id = $order->id;
            $log->log = 'Order Arrived At Nedco';
            $log->save();
            
            $notifications = new Notifications();
            $notifications->order_id = $order->id;
            $notifications->message = "New Order To Assign";
            $notifications->is_seen = 0;
            $notifications->type = 'dispatcher';
            $notifications->save();
            
            $dispatchers = Dispatcher::with('user')->where('status', 'approved')->get();
            foreach($dispatchers as $dispatcher) {
                if (isset($dispatcher->user)) {
                    $message = 'There is a new order !'; 
                    $title = 'Hey '.$dispatcher->user->name;
                    $player_id = $dispatcher->user->player_id;
                    if (isset($dispatcher->user->player_id) && $player_id != '') {
                        app('App\Http\Controllers\NotificationController')->sendNtoification($player_id, $message, $title);
                    }
                }
            }
            
            return $order;
        } else if ($request->status == 'Cancelled') {
            $order = Order::where('barcode', $request->barcode)->with('assigned_order')->first();
            
            Order::where('barcode', $request->barcode)->update([
                'status' => $request->status
            ]);
            
            $client = Client::where('id', $order->client_id)->with('user')->first();
            
            if (isset($client->user->player_id)) {
                $message = 'Your Order Has been Cancelled'; 
                $title = 'Hey '.$client->user->name;
                
                $log = new OrdersLogs();
                $log->order_id = $order->id;
                $log->log = 'Order has been Cancelled';
                $log->save();
                app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
            }
            return $order;
        } else if ($request->status == 'Out For Delivery') {
            Order::where('barcode', $request->barcode)->update([
                'status' => $request->status
            ]);
            
            $order = Order::where('barcode', $request->barcode)->with('assigned_order')->first();
            $client = Client::where('id', $order->client_id)->with('user')->first();
            
            $message = 'Your Order Number #'.$order->id." Is on the way"; 
            $title = 'Hey '.$client->user->name;
            $log = new OrdersLogs();
            $log->order_id = $order->id;
            $log->log = 'Order Is Out For Delivery';
            $log->save();
            app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
                
            return $order;
        } else if ($request->status == 'Out Of Reach') {
            $order = Order::where('barcode', $request->barcode)->with('assigned_order')->first();
            
            Order::where('barcode', $request->barcode)->update([
                'status' => $request->status
            ]);

            $client = Client::where('id', $order->client_id)->with('user')->first();
            
            $message = 'The recipient of the order number #'.$order->id.' is out of reach'; 
            $title = 'Hey '.$client->user->name;
            $log = new OrdersLogs();
            $log->order_id = $order->id;
            $log->log = 'Recipient was out of reach';
            $log->save();
            app('App\Http\Controllers\NotificationController')->sendNtoification($client->user->player_id, $message, $title);
                
            return $order;
        } else {
            $order = Order::where('barcode', $request->barcode)->with('assigned_order')->first();
            
            Order::where('barcode', $request->barcode)->update([
                'status' => $request->status
            ]);

            return $order;
        }
    }
    
    public function resetOrderData(Request $request)
    {
        $order = Order::find($request->id);
            
        Order::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        
        $AssignOrders = AssignOrders::firstOrNew(array('order_id' => $request->id));
        if ($request->driver_id != 'null') {
            $AssignOrders->Driver_id = $request->driver_id;
        } else {
            $AssignOrders->Driver_id = null;
        }
        $AssignOrders->Order_id = $request->id;
        $AssignOrders->delivery_date = $request->delivery_date;
        $AssignOrders->save();
           
        return $order;
    }
    
    public function clientsDeliverPrices(Request $request)
    {
        $districtsPrices = DistrictsPrices::with('user')->with('Districts')->get();
        $districts = Districts::all();
        $clients = Client::all();
        return view('admin.ClientsDeliveryPrices', compact('districtsPrices', 'districts', 'clients'));
    }
    
}
