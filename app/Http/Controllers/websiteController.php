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
use DB;

class websiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('gest');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function track(Request $request)
    {
        return view('track');
    }
    
    public function trackresult(Request $request)
    {
        if($request->get('Between') == "" && $request->get('And') == "")
        {
            $Order = Order::where('id',$request->get('shipment-number'))->get();
        }
        else
        {
            $Order = Order::where('client_id',$request->get('shipment-number'))->get();
        }
        return view('track-result',compact(['Order'])); 
        
    }
    
    public function CheckShappingRate(Request $request)
    {
        $locations = Location::all();
        return view('CheckShappingRate', compact(['locations']));
    }
    
    public function Services(Request $request)
    {
        return view('Services');
    }
    
    public function Clients(Request $request)
    {
        return view('Clients');
    }
    
    public function Contact(Request $request)
    {
        return view('Contact');
    }
    
    public function confirmLocation(Request $request)
    {
        $lat = $request->lat;
        $lon = $request->lon;
        return view('map.map', compact(['lat', 'lon']));
    }
}
